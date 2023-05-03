let imagesIcon = document.getElementsByClassName('img-icon-T')
Array.from(imagesIcon).forEach(img =>{
    img.addEventListener('click', e=>{
        cleanAll()
        e.target.style.border = '3px solid rgb(255,255,255)'
        document.getElementById('current-image').src = e.target.src
    })
})
function cleanAll(){
    Array.from(imagesIcon).forEach(img =>{
        img.style.border = 'none'
    })
}
