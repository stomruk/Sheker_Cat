let imagesIcon = document.getElementsByClassName('img-icon')
Array.from(imagesIcon).forEach(img =>{
    img.addEventListener('click', e=>{
        cleanAll()
        e.target.style.border = '10px solid green'
        e.target.style.borderRadius = '15px'
        document.getElementById('current').src = e.target.src
    })
})
function cleanAll(){
    Array.from(imagesIcon).forEach(img =>{
        img.style.border = 'none'
        img.style.borderRadius = '0px'
    })
}
document.getElementById('clikc').addEventListener('click', e=>{
    alert('tyjerg')
})