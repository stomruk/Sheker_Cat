

let Selectedtab = 'head-options'
let Heads = document.getElementsByClassName('head-options')
let Hairs = document.getElementsByClassName('hair-options')

let colors = document.getElementsByClassName('grid-color')


Array.from(colors).forEach(col => {
    document.getElementById(col.id).style.gridRow = "1 / 3"
    document.getElementById(col.id).style.backgroundColor = skinColor[num]
    num++;
})

document.getElementById('hair-btn').addEventListener('click', e=>{
    Selectedtab = Hairs
    changeTab(Heads)
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 2"
        document.getElementById(col.id).style.backgroundColor = hairCol[num]
        num++;
    })
})
document.getElementById('head-btn').addEventListener('click', e=>{
    Selectedtab = Heads
    changeTab(Hairs)
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 3"
        document.getElementById(col.id).style.backgroundColor = skinColor[num]
        num++;
    })
})

function changeTab(target){
    if (Selectedtab === Hairs){
        sect = 'hair'
    }
    else if (Selectedtab === Heads){
        sect = 'head'
    }
    Array.from(Selectedtab).forEach(t =>{
        t.style.display = 'inline-block'
    })
    Array.from(target).forEach(t =>{
        t.style.display = 'none'
    })
}
function changeHair(style, color){
    document.getElementById('hair').style.backgroundImage = 'url(../media/avatar/hair/'+style+'/'+color+'.png)'
}
function changeHead(type,color){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+type+'/'+color+'.png)'
}


/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
