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
        if (typeof this.content === "string") {
            let podElement = document.createElement("PodElement");
            podElement.innerHTML = this.content;
            podElement.id = this.identifier;
            podElement.onclick = () => {
                globalPages[this.parent].selectPodElement(this);
            };
            return podElement;
        }
        return this.content;
    }

    // From datatypes
    static fromSong(song) {
        return new PodElement(
            EyePod.renderSongContent(song.id),
            `song${song.id}`,
            function () {
                EyePod.playSong(song.id);
            },
            song.parent
        );
    }
}

class Page {
    content;
    menuCallback;
    skipCallback;
    pickCallback;
    playCallback;
    /**
     *
     * @param {PodElement[]} content
     * @param {function} menuCallback
     * @param {function} skipCallback
     * @param {function} pickCallback
     * @param {function} playCallback
     */
    constructor(
        content,
        menuCallback = undefined,
        skipCallback = undefined,
        pickCallback = undefined,
        playCallback = undefined
    ) {
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
        let screen = document.querySelector("div.screen");
        screen.querySelectorAll("PodElement").forEach((element) => {
            element.remove();
        });
        // Take each element in the page and render it
        this.content.forEach((element) => {
            let podElement;
            if (element.content instanceof HTMLElement) {
                podElement = element.content;
            } else {
                podElement = document.createElement("PodElement");
                podElement.innerHTML = element.content;
            }
            podElement.id = element.identifier;
            podElement.onclick = () => {
                globalPages[element.parent].selectPodElement(element);
            };
            screen.appendChild(podElement);
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
     * @returns {{title: string, artist: string, album: string, year: string, genre: string, duration: string, lyrics: string}}
     */
    static getSongData(id) {
        return {
            title: "Song Title",
            artist: "Artist Name",
            album: "Album Name",
            year: "Year",
            genre: "Genre",
            duration: "Duration",
            lyrics: "Lyrics",
        };
    }

    /**
     * Renders the content of a song for a given song ID.
     *
     * @param {number} id - The ID of the song.
     * @returns {HTMLElement} - The HTML element containing the song content.
     */
    static renderSongContent(id) {
        let songData = this.getSongData(id);
        let songContent = document.createElement("PodElement");
        songContent.innerHTML = `
            <div>
                <h1>${songData.title}</h1>
                <h4>${songData.artist}</h4>
                <span>${songData.album}</span>
                <span>- ${songData.year}</span>
                <span>- ${songData.genre}</span>
                <span>- ${songData.duration}</span>
            </div>`;
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
        case "ArrowUp":
        case "w":
            menuClick();
            break;
        case "ArrowRight":
        case "d":
            skipClick();
            break;
        case "ArrowDown":
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
    function () {
        globalEyePod = new EyePod(globalPages["home"]);
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
    ),
    songs: new Page(
        [
            PodElement.fromSong({ id: 1, parent: "songs" }),
            PodElement.fromSong({ id: 2, parent: "songs" }),
            PodElement.fromSong({ id: 3, parent: "songs" }),
            PodElement.fromSong({ id: 4, parent: "songs" }),
            PodElement.fromSong({ id: 5, parent: "songs" }),
            PodElement.fromSong({ id: 6, parent: "songs" }),
            PodElement.fromSong({ id: 7, parent: "songs" }),
            PodElement.fromSong({ id: 8, parent: "songs" }),
            PodElement.fromSong({ id: 9, parent: "songs" }),
            PodElement.fromSong({ id: 10, parent: "songs" }),
            PodElement.fromSong({ id: 11, parent: "songs" }),
            PodElement.fromSong({ id: 12, parent: "songs" }),
            PodElement.fromSong({ id: 13, parent: "songs" }),
            PodElement.fromSong({ id: 14, parent: "songs" }),
            PodElement.fromSong({ id: 15, parent: "songs" }),
        ],
    ),
};
