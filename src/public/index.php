<!doctype html>
<html lang="en">
<head>
    <title>My Croppa</title>
    <meta charset="UTF-8">
    <meta name="author" content="Sukhdev Mohan">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <script src="js/index.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Croppa</h1>
        </div>

        <div id="images">
            <label>
                Image:
                <select id ="image" name="image" onchange="drawToCanvas('original', value, {operation: 'original'})">
                    <option value="" disabled selected>Select Image</option>
                    <option value="big_1.jpg">Horizontal Image 1</option>
                    <option value="big_2.jpg">Horizontal Image 2</option>
                    <option value="vert_1.jpg">Vertical Image 1</option>
                    <option value="vert_2.png">Vertical Image 2</option>
                </select>
            </label>
        </div>

        <hr>

        <div class="box">
            <div class="element">
                <h2 class="heading">Original</h2>
                <div class="frame">
<!--                    <img src="/view/big_1.jpg?operation=original&height=0&width=0" alt="image" title="original" id="original" />-->
                    <canvas id="original"></canvas>
                </div>

                <p id="original-info" class="info"></p>
                <form id="manipulate-image">
                    <div>
                        <label>
                            Height:
                            <input type="number" name="height" id="height" step="1" value="0" />
                        </label>
                    </div>
                    <div>
                        <label>
                            Width:&nbsp;
                            <input type="number" name="width" id="width" step="1" value="0" />
                        </label>
                    </div>
                    <div>
                        <fieldset>
                            <legend>Operation</legend>
                            <label>
                                Crop:
                                <input type="radio" name="operation" value="crop" />
                            </label>
                            <label>
                                Resize:
                                <input type="radio" name="operation" value="resize" />
                            </label>

                            <p>Attention: cropping will start from coordinates (0,0)</p>
                        </fieldset>
                    </div>

                    <div>
                        <button>sumbit</button>
                    </div>
                </form>
            </div>

            <div class="element">
                <h2 class="heading">Crop</h2>
                <div class="frame">
<!--                    <img src="/view/big_1.jpg?&operation=crop&height=100&width=10" alt="image" title="original" id="original" />-->
                    <canvas id="crop"></canvas>
                </div>
                <p id="crop-info" class="info"></p>
            </div>

            <div class="element">
                <h2 class="heading">Resize</h2>
                <div class="frame original">
<!--                    <img src="/view/big_1.jpg?operation=resize&height=200&width=0" alt="image" title="original" id="original" />-->
                    <canvas id="resize"></canvas>
                </div>
                <p id="resize-info" class="info"></p>
            </div>
        </div>
    </div>

    <script>
        let form = document.getElementById('manipulate-image');
        form.addEventListener("submit", async (e) => {
            e.preventDefault();

            const height = parseInt(form.elements['height'].value, 10);
            const width = parseInt(form.elements['width'].value, 10);
            const operation = document.querySelector('input[name="operation"]:checked').value;

            if (!height && !width) {
                alert("PLEASE INSERT A VALUE FOR HEIGHT OR WIDTH. BOTH CAN'T BE 0");
                return;
            }
            if (null === operation) {
                alert("PLEASE SELECT OPERATION");
                return;
            }

            const src = document.getElementById('image').value
            const params = {
                operation: operation,
                height: height,
                width: width
            };

            await drawToCanvas(operation, src, params)
        });

    </script>
</body>
</html>