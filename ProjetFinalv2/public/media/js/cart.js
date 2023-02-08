// items = document.getElementsByClassName('cartItem')
//
//
//
// Array.from(items).forEach(item => {
//     document.getElementById('game'+item.id).addEventListener('click', e=>{gift(item.id)});
//     if (document.getElementById('sendTo'+item.id) != null){
//         document.getElementById('sendTo'+item.id).addEventListener('click', e=>{sendTo(item.id)});
//     }
// })
//

let items = document.getElementsByClassName('giftbox')

Array.from(items).forEach(item => {
    document.getElementById(item.id).addEventListener('click', e=> {
        gift(e.target.id)
    })
    if (item.checked){
        document.getElementById('gift'+item.id).style.display = 'block'
    }
    document.getElementById('changeGift'+item.id).addEventListener('click', e=>{
        document.getElementById('friendlist'+item.id).style.display = 'flex'
    })
    document.getElementById('cancel'+item.id).addEventListener('click', e=>{
        document.getElementById('friendlist'+item.id).style.display = 'none'
    })
})

function gift(id){
    if (document.getElementById(id).checked){
        window.location.href = '/gift/'+id+''
    }
    else{
        window.location.href = '/ungift/'+id+''
    }
}
function sendTo(id){
    document.getElementById('target-users'+id).style.display = 'block'
    document.getElementById('sendTo'+id).style.display = 'none'
}

