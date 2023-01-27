items = document.getElementsByClassName('cartItem')

Array.from(items).forEach(item => {
    document.getElementById('game'+item.id).addEventListener('click', e=>{gift(item.id)});
    if (document.getElementById('sendTo'+item.id) != null){
        document.getElementById('sendTo'+item.id).addEventListener('click', e=>{sendTo(item.id)});
    }
})

function gift(id){
    if (document.getElementById('game'+id).checked){
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