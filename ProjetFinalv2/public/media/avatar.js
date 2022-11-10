
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
function changeHead(type,color, id){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+type+'/'+color+')'
    document.getElementById('headChoice'+id+'').checked = true
}
function changeEyes(type,color, id){
    document.getElementById('eyes').style.backgroundImage = 'url(../media/avatar/eyes/'+type+'/'+color+')'
}
function changeMouth(type,color, id){
    document.getElementById('mouth').style.backgroundImage = 'url(../media/avatar/mouth/'+type+'/'+color+')'
    document.getElementById('mouthChoice'+id+'').checked = true
}
function changeNose(type,color, id){
    document.getElementById('nose').style.backgroundImage = 'url(../media/avatar/nose/'+type+'/'+color+')'
    document.getElementById('noseChoice'+id+'').checked = true
}
function changeCloth(type,color){
    document.getElementById('cloth').style.backgroundImage = 'url(../media/avatar/cloth/'+type+'/'+color+')'
}

function changeSkin(head, mouth, nose,color, id){
    document.getElementById('head').style.backgroundImage = 'url(../media/avatar/head/'+head+'/'+color+')'
    document.getElementById('mouth').style.backgroundImage = 'url(../media/avatar/mouth/'+mouth+'/'+color+')'
    document.getElementById('nose').style.backgroundImage = 'url(../media/avatar/nose/'+nose+'/'+color+')'
    document.getElementById('Skincolor'+id+'').checked = true
}

function HairSelection(hair, color){
    document.getElementById('hairChoice'+hair+'').checked = true
    document.getElementById('Haircolor'+color+'').checked = true
}
function EyeSelection(eye, color){
    document.getElementById('eyeChoice'+eye+'').checked = true
    document.getElementById('Eyecolor'+color+'').checked = true
}
function ClothSelection(cloth, style){
    document.getElementById('clothChoice'+cloth+'').checked = true
    document.getElementById('clothStyle'+style+'').checked = true
}


/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
