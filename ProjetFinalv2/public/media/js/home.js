let cover = document.getElementById('sale-cover')
let counter = 0
let images = [];


document.getElementById('next-arrow').addEventListener('click', e=>{
    counter++
    if (counter >= images.length){
        counter = 0
    }
    document.getElementById('current-sale').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('current-sale').style.opacity = '1';
        cover.src = '../media/Sale/'+images[counter]+'.png'
    }, "500")
})
document.getElementById('previous-arrow').addEventListener('click', e=>{
    counter--
    if (0 > counter){
        counter = images.length - 1
    }
    document.getElementById('current-sale').style.opacity = '0';
    setTimeout(() => {
        document.getElementById('current-sale').style.opacity = '1';
        cover.src = '../media/Sale/'+images[counter]+'.png'
    }, "500")
})