
let colors = document.getElementsByClassName('grid-color')

document.getElementById('head-btn').addEventListener('click', e=>{
    selection = 'head'
    changeTo(selection)
})
document.getElementById('hair-btn').addEventListener('click', e=>{
    selection = 'hair'
    changeTo(selection)
})
document.getElementById('eyes-btn').addEventListener('click', e=>{
    selection = 'eyes'
    changeTo(selection)
})
document.getElementById('mouth-btn').addEventListener('click', e=>{
    selection = 'mouth'
    changeTo(selection)
})
document.getElementById('nose-btn').addEventListener('click', e=>{
    selection = 'nose'
    changeTo(selection)
})
document.getElementById('cloth-btn').addEventListener('click', e=>{
    selection = 'cloth'
    changeTo(selection)
})

function changeHair(style, color){
    document.getElementById('hair').style.backgroundImage = 'url(../media/avatar/hair/'+style+'/'+color+')'
}
function changeHead(type,color){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+type+'/'+color+')'
}
function changeEyes(type,color){
    document.getElementById('eyes').style.backgroundImage = 'url(../media/avatar/eyes/'+type+'/'+color+')'
}
function changeMouth(type,color){
    document.getElementById('mouth').style.backgroundImage = 'url(../media/avatar/mouth/'+type+'/'+color+')'
}
function changeNose(type,color){
    document.getElementById('nose').style.backgroundImage = 'url(../media/avatar/nose/'+type+'/'+color+')'
}
function changeCloth(type,color){
    document.getElementById('cloth').style.backgroundImage = 'url(../media/avatar/cloth/'+type+'/'+color+')'
}

function changeSkin(head, mouth, nose,color){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+head+'/'+color+')'
    document.getElementById('mouth').style.backgroundImage = 'url(../media/avatar/mouth/'+mouth+'/'+color+')'
    document.getElementById('nose').style.backgroundImage = 'url(../media/avatar/nose/'+nose+'/'+color+')'
}


/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
