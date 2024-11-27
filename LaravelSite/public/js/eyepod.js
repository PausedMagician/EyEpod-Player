//#region Move this later

function ReadableTime(time) {
    let minutes = Math.floor(time / 60);
    let seconds = Math.floor(time % 60);
    return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
}

//#endregion



class PodElement {
    selected = false;
    content;
    identifier;
    callback;
    parent;

    /**
     *
     * @param {string | HTMLElement} content
     * @param {function} callback
     * @param {string} parent
     */
    constructor(content, identifier, callback, parent) {
        this.content = content;
        this.identifier = identifier;
        this.callback = callback;
        this.parent = parent; // The key of the parent page
    }

    select() {
        this.selected = true;
        let element = document.getElementById(this.identifier);
        element.classList.add("selected");
        element.scrollIntoView({ block: "nearest", behavior: "smooth" });
    }
    deselect() {
        this.selected = false;
        document.getElementById(this.identifier).classList.remove("selected");
    }

    activate() {
        this.callback(this);
    }

    render() {
        if (this.content instanceof HTMLElement) {
            console.log("Returning element");
            console.log(this.content);
            return this.content;
        }
        console.log("Rendering string");
        let podElement = document.createElement("PodElement");
        let inner = "<span>{CONTENT}</span><span>></span>";
        podElement.innerHTML = inner.replaceAll("{CONTENT}", this.content);
        podElement.id = this.identifier;
        podElement.onclick = () => {
            globalPages[this.parent].selectPodElement(this);
        };
        return podElement;
    }

    // From datatypes
    static async fromSong(song) {
        const content = await EyePod.renderSongContent(song);
        console.log(content);
        return new PodElement(
            content,
            `song${song}`,
            function () {
                EyePod.playSong(song);
            },
            song.parent
        );
    }
}

class Page {
    title;
    content;
    menuCallback;
    skipCallback;
    pickCallback;
    playCallback;
    /**
     *
     * @param {string} title
     * @param {PodElement[]} content
     * @param {function} menuCallback
     * @param {function} skipCallback
     * @param {function} pickCallback
     * @param {function} playCallback
     */
    constructor(
        title,
        content,
        menuCallback = undefined,
        skipCallback = undefined,
        pickCallback = undefined,
        playCallback = undefined
    ) {
        this.title = title;
        this.content = content;
        this.menuCallback = menuCallback;
        this.skipCallback = skipCallback;
        this.pickCallback = pickCallback;
        this.playCallback = playCallback;
    }

    menuClick() {
        console.log("Menu");
        if (this.menuCallback) {
            this.menuCallback(this);
        } else {
            globalEyePod.goToPage("home");
        }
    }
    skipClick() {
        console.log("Skip");
        if (this.skipCallback) {
            this.skipCallback(this);
        } else {
            EyePod.nextSong();
        }
    }
    pickClick() {
        console.log("Pick");
        if (this.pickCallback) {
            this.pickCallback(this);
        } else {
            EyePod.previousSong();
        }
    }
    playClick() {
        console.log("Play");
        if (this.playCallback) {
            this.playCallback(this);
        } else {
            EyePod.pauseResumeSong();
        }
    }
    middClick() {
        console.log("Middle");
        this.activatePodElement();
    }

    nextPodElement() {
        // Need to find the selected elements index and add one and mod by the length of the array
        let elementIndex = this.content.indexOf(
            this.content.find((x) => x.selected)
        );
        let nextPodElement =
            this.content[(elementIndex + 1) % this.content.length];
        this.content[elementIndex].deselect();
        nextPodElement.select();
    }

    previousPodElement() {
        // Need to find the selected elements index and subtract one and mod by the length of the array
        let newElementIndex = this.content.indexOf(
            this.content.find((x) => x.selected)
        );
        let oldElementIndex =
            (newElementIndex == 0 ? this.content.length : newElementIndex) - 1;
        let previousPodElement =
            this.content[oldElementIndex % this.content.length];
        this.content[newElementIndex].deselect();
        previousPodElement.select();
    }

    activatePodElement() {
        this.content.find((x) => x.selected).activate();
    }

    /**
     *
     * @param {PodElement} podElement
     * @returns
     */
    selectPodElement(podElement) {
        if (podElement.selected) {
            podElement.activate();
            return;
        }
        this.content.forEach((element) => {
            if (element.selected) {
                element.deselect();
            }
        });
        podElement.select();
    }

    render() {
        // Render the page
        document.querySelector(".status-bar .status-text").innerText = this.title;
        let screen = document.querySelector("div.screen");
        screen.querySelectorAll("PodElement").forEach((element) => {
            element.remove();
        });
        // Take each element in the page and render it
        this.content.forEach((element) => {
            let rendered = element.render();
            console.log(rendered);
            screen.appendChild(rendered);
        });
        let selected = this.content.find((x) => x.selected);
        if (selected) {
            selected.select();
        } else {
            this.content[0].select();
        }
    }
}

class EyePod {
    /**
     * @type {HTMLAudioElement}
     * @description The current song being played
     * @static
     */
    static song;
    static songId = -1;

    /**
     * @type {number[]}
     * @description The queue of songs to play
     * @static
     */
    static queue = [];

    /**
     *
     * @param {Page} page
     */
    constructor(page) {
        this.page = page;
    }

    /**
     * 
     * @param {string} page
     */
    goToPage(page) {
        this.page = globalPages[page];
        this.render();
    }

    render() {
        if (this.page) {
            this.page.render();
        }
    }

    /**
     *
     * @param {number} id
     * @returns {Promise<{title: string, artist: string, album: string, year: string, genre: string, duration: string, lyrics: string}>}
     */
    static async getSongData(id) {
        // return {
        //     title: "Song Title",
        //     artist: "Artist Name",
        //     album: "Album Name",
        //     year: "Year",
        //     genre: "Genre",
        //     duration: "Duration",
        //     lyrics: "Lyrics",
        // };
        const response = await (await fetch(`/song/get/${id}`)).json();
        console.log(response);
        return response;
    }

    /**
     * Renders the content of a song for a given song ID.
     *
     * @param {number} id - The ID of the song.
     */
    static async renderSongContent(id) {
        const songData = await this.getSongData(id);
        console.log(songData);
        let songContent = document.createElement("PodElement");
        songContent.innerHTML = `
                <div>
                    <h1>${songData.title}</h1>
                    <h4>${songData.album.artist.name}</h4>
                    <span>${songData.album.name}</span>
                    <span>- ${songData.album.release_date}</span>
                    <span>- ${songData.genre.name}</span>
                    <span>- ${ReadableTime(songData.length)}</span>
                </div>`;
        songContent.id = `song${id}`;
        return songContent;
    }

    static playSong(id) {
        this.stopSong();
        this.songId = id;
        console.log("Playing song " + id);
        this.song = new Audio(`audio/${id}.mp3`);
        this.song.play();
        this.song.addEventListener("timeupdate", function () {
            document.querySelector(".player .progress progress").value =
                (this.currentTime / this.duration) * 100;
        });
        document.querySelector(".player").classList.add("playing");
        document.querySelector(".eyepod").classList.add("playing");
    }

    static stopSong() {
        if (this.song) {
            this;
            this.song.pause();
            this.song = null;
            document.querySelector(".player").classList.remove("playing");
            document.querySelector(".eyepod").classList.remove("playing");
        }
    }

    static pauseResumeSong() {
        if (this.song) {
            if (this.song.paused) {
                console.log("Resuming song");
                this.song.play();
            } else {
                console.log("Pausing song");
                this.song.pause();
            }
        }
    }

    static nextSong() {
        if (this.song) {
            this.song.pause();
            this.song = null;
        }
        if (this.queue.length == 0) { return; }
        let index = this.queue.findIndex((x) => x == this.songId);
        if (index == -1) {
            this.playSong(this.queue[0]);
        } else {
            this.playSong(this.queue[(index + 1)%this.queue.length]);
        }
    }

    static previousSong() {
        if (this.song) {
            this.song.pause();
            this.song = null;
        }
        if (this.queue.length == 0) { return; }
        let index = this.queue.findIndex((x) => x == this.songId);
        if (index == -1 || index == this.queue.length-1) {
            this.playSong(this.queue[0]);
        } else {
            this.playSong(this.queue[(index - 1)%this.queue.length]);
        }
    }
}

var globalEyePod = new EyePod(null);

function menuClick(param) {
    globalEyePod.page.menuClick();
}
function skipClick(params) {
    globalEyePod.page.skipClick();
}
function pickClick(params) {
    globalEyePod.page.pickClick();
}
function playClick(params) {
    globalEyePod.page.playClick();
}
function middClick(params) {
    globalEyePod.page.middClick();
}

/**
 *
 * @param {KeyboardEvent} e
 */
function handleKeyDown(e) {
    switch (e.key) {
        case "w":
            menuClick();
            break;
        case "ArrowRight":
        case "d":
            skipClick();
            break;
        case "x":
            playClick();
            break;
        case "ArrowLeft":
        case "a":
            pickClick();
            break;
        case "Enter":
        case "s":
            middClick();
            break;
        case "ArrowUp":
            globalEyePod.page.previousPodElement();
            break;
        case "ArrowDown":
            globalEyePod.page.nextPodElement();
            break;
        default:
            break;
    }
}

function handleRotation(e) {
    if (e.deltaY > 5) {
        globalEyePod.page.nextPodElement();
    } else if(e.deltaY < -5) {
        globalEyePod.page.previousPodElement();
    }
}


document.addEventListener(
    "DOMContentLoaded",
    async function () {
        globalEyePod = new EyePod(globalPages["home"]);
        globalPages["songs"] = new Page("Songs", []);
        let data = await (await fetch("/songs/get")).json();
        for (song of data) {
            console.log(song);
            let pod = await PodElement.fromSong(song.id);
            console.log(pod);
            globalPages["songs"].content.push(pod);
        }
        globalEyePod.render();
        globalEyePod.page.content[0].select();
        document.addEventListener("keydown", handleKeyDown);
        document
            .querySelector(".eyepod .wheel")
            .addEventListener("wheel", handleRotation);
    },
    false
);

let globalPages = {
    home: new Page(
        "EyePod",
        [
            new PodElement(
                "Songs",
                "songs",
                function () {
                    globalEyePod.goToPage("songs");
                    console.log("Songs");
                },
                "home"
            ),
            new PodElement(
                "Artists",
                "artists",
                function () {
                    console.log("Artists");
                },
                "home"
            ),
            new PodElement(
                "Albums",
                "albums",
                function () {
                    console.log("Albums");
                },
                "home"
            ),
            new PodElement(
                "Playlists",
                "playlists",
                function () {
                    console.log("Playlists");
                },
                "home"
            ),
            new PodElement(
                "Settings",
                "settings",
                function () {
                    console.log("Settings");
                },
                "home"
            ),
        ],
    )
};
