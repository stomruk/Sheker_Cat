

let Selectedtab = 'head-options'
let Heads = document.getElementsByClassName('head-options')
let Hairs = document.getElementsByClassName('hair-options')
let Eyes = document.getElementsByClassName('eyes-options')
let Mouths = document.getElementsByClassName('mouth-options')

let Alltabs = [Heads, Hairs, Eyes, Mouths]

let colors = document.getElementsByClassName('grid-color')


Array.from(colors).forEach(col => {
    document.getElementById(col.id).style.gridRow = "1 / 3"
    document.getElementById(col.id).style.backgroundColor = skinColor[num]
    num++;
})

document.getElementById('head-btn').addEventListener('click', e=>{
    Selectedtab = Heads
    changeTab()
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 3"
        document.getElementById(col.id).style.backgroundColor = skinColor[num]
        num++;
    })
})

document.getElementById('hair-btn').addEventListener('click', e=>{
    Selectedtab = Hairs
    changeTab()
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 2"
        document.getElementById(col.id).style.backgroundColor = hairColors[num]
        num++;
    })
})

document.getElementById('eyes-btn').addEventListener('click', e=>{
    Selectedtab = Eyes
    changeTab()
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 2"
        document.getElementById(col.id).style.backgroundColor = hairColors[num]
        num++;
    })
})

document.getElementById('mouth-btn').addEventListener('click', e=>{
    Selectedtab = Mouths
    changeTab()
    num = 0
    Array.from(colors).forEach(col => {
        document.getElementById(col.id).style.gridRow = "1 / 3"
        document.getElementById(col.id).style.backgroundColor = skinColor[num]
        num++;
    })
})

function changeTab(){
    if (Selectedtab === Hairs){
        sect = 'hair'
    }
    else if (Selectedtab === Heads){
        sect = 'head'
    }
    else if (Selectedtab === Eyes){
        sect = 'eyes'
    }
    else if (Selectedtab === Mouths){
        sect = 'mouth'
    }
    Array.from(Alltabs).forEach(t =>{
        Array.from(t).forEach(f=>{
            f.style.display = 'none'
        })
    })
    Array.from(Selectedtab).forEach(t =>{
        t.style.display = 'inline-block'
    })
}
function changeHair(style, color){
    document.getElementById('hair').style.backgroundImage = 'url(../media/avatar/hair/'+style+'/'+color+'.png)'
}
function changeHead(type,color){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+type+'/'+color+'.png)'
}
function changeEyes(type,color){
    document.getElementById('eyes').style.backgroundImage = 'url(../media/avatar/eyes/'+type+'/'+color+'.png)'
}
function changeMouth(type,color){
    document.getElementById('mouth').style.backgroundImage = 'url(../media/avatar/mouth/'+type+'/'+color+'.png)'
}


/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
