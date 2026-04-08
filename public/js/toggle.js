const containerButton = document.getElementsByClassName("application-button");
const containers = document.getElementsByClassName("application-body");
for (let i = 0; i < containers.length; i++) {
    containerButton[i].addEventListener('click', function(){
        containers[i].classList.toggle("hidden");
    })
}
