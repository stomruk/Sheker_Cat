let bio = false


document.getElementById('friend').onclick = friendTable;

function editBio(){
    if (bio == false){
        document.getElementById('profil-bio-text').style.display = 'none'
        document.getElementById('profil-bio-form').style.display = 'block'
        document.getElementById('cancel-desc').style.display = 'inline-block'
        bio = true
    }
    else if(bio == true){
        document.getElementById('profil-bio-text').style.display = 'block'
        document.getElementById('profil-bio-form').style.display = 'none'
        document.getElementById('cancel-desc').style.display = 'none'
        bio = false
    }
}
function cancelBio(){
    document.getElementById('profil-bio-text').style.display = 'block'
    document.getElementById('profil-bio-form').style.display = 'none'
    document.getElementById('cancel-desc').style.display = 'none'
    bio = false
}function friendTable(){
    if (document.getElementById('friend-table').style.display == 'none'){
        document.getElementById('friend-table').style.display = 'block'
        document.getElementById('profil-bio-text').style.display = 'none'
    }
    else if (document.getElementById('friend-table').style.display == 'block'){
        document.getElementById('friend-table').style.display = 'none'
        document.getElementById('profil-bio-text').style.display = 'block'
    }
}
function gotoAvatar(){
    window.location.href = 'http://localhost:8000/avatar'
}