let imagesIcon = document.getElementsByClassName('img-icon')
Array.from(imagesIcon).forEach(img =>{
    img.addEventListener('click', e=>{
        cleanAll()
        e.target.style.border = '3px solid rgb(255,255,255)'
        document.getElementById('current').src = e.target.src
    })
})
function cleanAll(){
    Array.from(imagesIcon).forEach(img =>{
        img.style.border = 'none'
    })
}
let reviews = document.getElementsByClassName('review-table')
let counter = 2

Array.from(reviews).forEach(rev => test(rev))

function test(value){

}
document.getElementById('back-arrow').onclick = backward;
document.getElementById('forward-arrow').onclick = forward;

function forward(){
    document.getElementById('review-section').scroll({top: 0, left: 750, behavior: 'smooth'})
}
function backward(){
    document.getElementById('review-section').scroll({top: 0, left: -750, behavior: 'smooth'})
}
