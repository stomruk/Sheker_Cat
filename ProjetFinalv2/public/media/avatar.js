let head = 'head1'
let mouth = 'mouth1'
let nose = 'nose1'
let skin = 'tile000.png'
let hair = 'hair1'
let hairColor = 'tile000.png'
let eyes = 'eyes1'
let eyesColor = 'tile000.png'
let cloth = 'cloth1'



let colors = document.getElementsByClassName('grid-color')
let colorsArray = document.getElementsByClassName('color-divs')


let heads = document.getElementsByClassName('head-options')
let hairs = document.getElementsByClassName('hair-options')
let eyesArray = document.getElementsByClassName('eyes-options')
let mouthArray = document.getElementsByClassName('mouth-options')
let noseArray = document.getElementsByClassName('nose-options')
let clothArray = document.getElementsByClassName('cloth-options')

let headFrame = document.getElementsByClassName('head-frame')
let hairFrame = document.getElementsByClassName('hair-frame')
let eyesFrame = document.getElementsByClassName('eye-frame')
let mouthFrame = document.getElementsByClassName('mouth-frame')
let noseFrame = document.getElementsByClassName('nose-frame')
let clothFrame = document.getElementsByClassName('cloth-frame')



let num = 0
let selection = 'head'
let skinColor = ['rgb(248,197,171)','rgb(254,224,214)','rgb(217,154,125)','rgb(164,115,103)','rgb(248,197,171)','rgb(254,224,214)','rgb(217,154,125)','rgb(164,115,103)']
let hairColors = ['rgb(129,105,82)','rgb(179,111,79)','rgb(254,241,198)','rgb(96,91,98)','rgb(194,215,188)','rgb(224,68,90)','rgb(248,247,233)','rgb(161,189,65)']
let eyesColors = ['rgb(66,136,193)','rgb(39,75,114)','rgb(31,152,154)','rgb(255,139,9)','rgb(96,57,45)','rgb(255,9,69)','rgb(110,80,152)','rgb(67,64,63)']
let icons = document.getElementsByClassName('icons')
let radios = document.getElementsByClassName('radio-btn')
let colorRadios = document.getElementsByClassName('clr_radio')





let head_id
let skin_id
let mouth_id
let eyes_id
let eye_color_id
let hair_id
let hair_color_id
let nose_id
let cloth_id
let style_id






changeTo(selection)

function changeTo(value){
    hideallFrame()
    Array.from(icons).forEach(icon =>{
        icon.style.display = 'none'
    })
    Array.from(radios).forEach(btn =>{
        btn.style.display = 'none'
    })
    num = 0
    if (value === 'head'){
        Array.from(colorsArray).forEach(color => {changeDivtoSkin(color)})
        showFrameImage(headFrame, heads)
    }
    if (value === 'hair'){
        Array.from(colorsArray).forEach(color => {changeDivtoColor(color, hairColors)})
        showFrameImage(hairFrame, hairs)
    }
    if (value === 'eyes'){
        Array.from(colorsArray).forEach(color => {changeDivtoColor(color, eyesColors)})
        showFrameImage(eyesFrame, eyesArray)
    }
    if (value === 'mouth'){
        Array.from(colorsArray).forEach(color => {changeDivtoSkin(color)})
        showFrameImage(mouthFrame, mouthArray)
    }
    if (value === 'nose'){
        Array.from(colorsArray).forEach(color => {changeDivtoSkin(color)})
        showFrameImage(noseFrame, noseArray)
    }
    if (value === 'cloth'){
        Array.from(colorsArray).forEach(color => {changeDivtoColor(color, hairColors)})
        showFrameImage(clothFrame, clothArray)
    }
}

function hideallFrame(){
    Array.from(headFrame).forEach(item => {item.style.display = 'none'})
    Array.from(eyesFrame).forEach(item => {item.style.display = 'none'})
    Array.from(hairFrame).forEach(item => {item.style.display = 'none'})
    Array.from(mouthFrame).forEach(item => {item.style.display = 'none'})
    Array.from(noseFrame).forEach(item => {item.style.display = 'none'})
    Array.from(clothFrame).forEach(item => {item.style.display = 'none'})
}
function showFrameImage(Frame, Image){
    Array.from(Image).forEach(item => {item.style.display = 'inline-block'})
    Array.from(Frame).forEach(item => {item.style.display = 'flex'})
}

function changeDivtoSkin(color){
    color.style.backgroundColor = skinColor[num];
    num++;
    color.style.margin = '0px 5px';
    color.style.borderRadius ='0px';
}
function changeDivtoColor(color, array){
    color.style.backgroundColor = array[num];
    num++;
    color.style.margin = '5px 5px';
    color.style.borderRadius ='10px';
}


Array.from(colorsArray).forEach(color => {
    color.addEventListener('click', e=>{
        if (selection === 'head' || selection === 'mouth' || selection === 'nose'){
            skin = e.target.id
            skin_id = e.target.title
            if (skin === 'tile004.png'){
                skin = 'tile000.png'
            }
            if (skin === 'tile005.png'){
                skin = 'tile001.png'
            }
            if (skin === 'tile006.png'){
                skin = 'tile002.png'
            }
            if (skin === 'tile007.png'){
                skin = 'tile003.png'
            }
            if (skin_id == 5){
                skin_id = 1
            }
            if (skin_id == 6){
                skin_id = 2
            }
            if (skin_id == 7){
                skin_id = 3
            }
            if (skin_id == 8){
                skin_id = 4
            }
            console.log(skin_id)
            changeSkin(head, mouth, nose, skin, skin_id)
        }
        if (selection === 'hair'){
            hairColor = e.target.id
            hair_color_id = e.target.title
            changeHair(hair, hairColor)
            HairSelection(hair_id, hair_color_id)
        }
        if (selection === 'eyes'){
            eyesColor = e.target.id
            eye_color_id = e.target.title
            changeEyes(eyes,eyesColor)
            EyeSelection(eyes_id,eye_color_id)
        }
        if (selection === 'cloth'){
            hairColor = e.target.id
            style_id = e.target.title
            changeCloth(cloth,hairColor)
            ClothSelection(cloth_id, style_id)
        }
    })
})


/* ------------------------------------------------------------------- */


document.getElementById('head-btn').addEventListener('click', e=>{
    removebuttonColor('head-btn')
    selection = 'head'
    changeTo(selection)
    })
document.getElementById('hair-btn').addEventListener('click', e=>{
    removebuttonColor('hair-btn')
    selection = 'hair'
    changeTo(selection)
})
document.getElementById('eyes-btn').addEventListener('click', e=>{
    removebuttonColor('eyes-btn')
    selection = 'eyes'
    changeTo(selection)
})
document.getElementById('mouth-btn').addEventListener('click', e=>{
    removebuttonColor('mouth-btn')
    selection = 'mouth'
    changeTo(selection)
})
document.getElementById('nose-btn').addEventListener('click', e=>{
    removebuttonColor('nose-btn')
    selection = 'nose'
    changeTo(selection)
})
document.getElementById('cloth-btn').addEventListener('click', e=>{
    removebuttonColor('cloth-btn')
    selection = 'cloth'
    changeTo(selection)
})

function removebuttonColor(target){
    document.getElementById('head-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById('hair-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById('eyes-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById('mouth-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById('nose-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById('cloth-btn').style.backgroundColor = 'var(--game-card)'
    document.getElementById(target).style.backgroundColor = 'var(--box-color)'

}

/* ----------------------------------------------------- */


Array.from(heads).forEach(h => {h.addEventListener('click', e=>{
    removeBackground(headFrame)
    document.getElementById('headFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    head = e.target.alt
    head_id = e.target.id
    changeHead(head, skin, head_id)
})})
Array.from(mouthArray).forEach(m => {m.addEventListener('click', e=>{
    removeBackground(mouthFrame)
    document.getElementById('mouthFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    mouth = e.target.alt
    mouth_id = e.target.id
    changeMouth(mouth, skin, mouth_id)
})})
Array.from(hairs).forEach(h => {h.addEventListener('click', e=>{
    removeBackground(hairFrame)
    document.getElementById('hairFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    hair = e.target.alt
    hair_id = e.target.id
    changeHair(hair, hairColor)
    HairSelection(hair_id, hair_color_id)
})})
Array.from(eyesArray).forEach(eye => {eye.addEventListener('click', e=>{
    removeBackground(eyesFrame)
    document.getElementById('eyeFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    eyes = e.target.alt
    eyes_id = e.target.id
    changeEyes(eyes, eyesColor)
    EyeSelection(eyes_id,eye_color_id)
})})
Array.from(noseArray).forEach(n => {n.addEventListener('click', e=>{
    removeBackground(noseFrame)
    document.getElementById('noseFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    nose = e.target.alt
    nose_id = e.target.id
    changeNose(nose, skin, nose_id)
})})
Array.from(clothArray).forEach(c => {c.addEventListener('click', e=>{
    removeBackground(clothFrame)
    document.getElementById('clothFrame'+e.target.id).style.backgroundColor = 'var(--game-card-alt)'
    cloth = e.target.alt
    cloth_id = e.target.id
    changeCloth(cloth, hairColor)
    ClothSelection(cloth_id, style_id)
})})

function removeBackground(array){
    Array.from(array).forEach(item => item.style.backgroundColor = 'var(--box-color)')
}


/* ----------------------------------------------------- */


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

/* ------------------------------------------------------------------------- */




/* "url({{ asset('media/avatar/'"+type+'"/'+skin+'".png'+")}})" */
