import * as url from "url";

let Selectedtab = 'head-options'
let Heads = document.getElementsByClassName('head-options')
let Hairs = document.getElementsByClassName('hair-options')


document.getElementById('hair-btn').addEventListener('click', e=>{
    Selectedtab = Hairs
    changeTab(Heads)
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 2"
    })
})
document.getElementById('head-btn').addEventListener('click', e=>{
    Selectedtab = Heads
    changeTab(Hairs)
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 3"
        document.getElementById(col.id).style.backgroundColor = skinColor[num]
        num++;
    })
})

function changeTab(target){
    Array.from(Selectedtab).forEach(t =>{
        t.style.display = 'inline-block'
    })
    Array.from(target).forEach(t =>{
        t.style.display = 'none'
    })
}

/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
