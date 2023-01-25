let bio = false
document.getElementById('edit-desc').onclick = editBio;
document.getElementById('cancel-desc').onclick = cancelBio;
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
}