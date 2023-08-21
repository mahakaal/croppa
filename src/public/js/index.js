async function loadImageAsBlob(source, parameters) {
    const queryParams = new URLSearchParams(parameters);
    const uri = `/view/${source}?${queryParams}`;
    const response = await fetch(uri);
    return response.ok ? response.blob() : Promise.reject(response.status);
}

async function drawToCanvas(canvasId, source, parameters) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext("2d");
    const imageBlob = await loadImageAsBlob(source, parameters);
    const bmp = await createImageBitmap(imageBlob);
    const {width, height} = bmp;
    const scale = 2;

    canvas.style.width = width + 'px';
    canvas.style.height = height + 'px';
    canvas.width  = width * scale;
    canvas.height = height * scale;
    ctx.drawImage(bmp, 0, 0, width * scale, height*scale);
    bmp.close();

    const infoBox = document.getElementById(`${canvasId}-info`);
    infoBox.innerText = `${width} x ${height}`;
}