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
    Array.from(icons).forEach(icon =>{
        icon.style.display = 'none'
    })
    Array.from(radios).forEach(btn =>{
        btn.style.display = 'none'
    })
    num = 0
    if (value === 'head'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = skinColor[num]; num++;})
        Array.from(heads).forEach(head => {head.style.display = 'inline-block'})
    }
    if (value === 'hair'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = hairColors[num]; num++;})
        Array.from(hairs).forEach(hair => {hair.style.display = 'inline-block'})
    }
    if (value === 'eyes'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = eyesColors[num]; num++;})
        Array.from(eyesArray).forEach(eyes => {eyes.style.display = 'inline-block'})
    }
    if (value === 'mouth'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = skinColor[num]; num++;})
        Array.from(mouthArray).forEach(mouth => {mouth.style.display = 'inline-block'})
    }
    if (value === 'nose'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = skinColor[num]; num++;})
        Array.from(noseArray).forEach(nose => {nose.style.display = 'inline-block'})
    }
    if (value === 'cloth'){
        Array.from(colorsArray).forEach(color => {color.style.backgroundColor = hairColors[num]; num++;})
        Array.from(clothArray).forEach(cloth => {cloth.style.display = 'inline-block'})
    }
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


/* ----------------------------------------------------- */


Array.from(heads).forEach(h => {h.addEventListener('click', e=>{
    head = e.target.alt
    head_id = e.target.id
    changeHead(head, skin, head_id)
})})
Array.from(mouthArray).forEach(m => {m.addEventListener('click', e=>{
    mouth = e.target.alt
    mouth_id = e.target.id
    changeMouth(mouth, skin, mouth_id)
})})
Array.from(hairs).forEach(h => {h.addEventListener('click', e=>{
    hair = e.target.alt
    hair_id = e.target.id
    changeHair(hair, hairColor)
    HairSelection(hair_id, hair_color_id)
})})
Array.from(eyesArray).forEach(eye => {eye.addEventListener('click', e=>{
    eyes = e.target.alt
    eyes_id = e.target.id
    changeEyes(eyes, eyesColor)
    EyeSelection(eyes_id,eye_color_id)
})})
Array.from(noseArray).forEach(n => {n.addEventListener('click', e=>{
    nose = e.target.alt
    nose_id = e.target.id
    changeNose(nose, skin, nose_id)
})})
Array.from(clothArray).forEach(c => {c.addEventListener('click', e=>{
    cloth = e.target.alt
    cloth_id = e.target.id
    changeCloth(cloth, hairColor)
    ClothSelection(cloth_id, style_id)
})})


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
