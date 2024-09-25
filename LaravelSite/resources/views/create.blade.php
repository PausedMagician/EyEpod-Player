<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href={{asset('css/style.css')}} >
</head>

<header>
    <h1><a href="..">EyePod</a></h1>
    <div>
        <ul>
            <li><a href="">Create Artist</a></li>
            <li><a href="">Create Album</a></li>
            <li><a href="">Artist</a></li>
        </ul>
    </div>
</header>

<body>

    <div class="container">
        <form onsubmit="return false;" id="input">
            <div class="container_input">
                <div>
                    <label for="artist_name">Artist Name</label>
                    <input type="text" id="artist_name">
                </div>
                <div>
                    <label for="genre">Genre</label>
                    <select name="genre" id="genre">
                        <option value="rock">Rock</option>
                        <option value="rap">Rap</option>
                    </select>
                </div>
                <div>
                    <label for="artist_desc">Description</label>
                    <textarea name="artist_desc" id="desc"></textarea>
                </div>
                <div>
                    <button class="add-button" onclick="addFn()">Add Input Field</button>
                    <div id="tracks_field"></div>
                </div>
        </form>
        <div class="button_div">
            <button type="submit" form="input" id="btn1" value="Submit">Submit</button>
        </div>
    </div>
</body>

<script defer src={{asset("js/create.js")}}></script>

</html>