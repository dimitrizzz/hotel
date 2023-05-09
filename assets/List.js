window.addEventListener('DOMContentLoaded', (event) => {
    const caption=document.querySelector(".Count");
    const events=(e) =>{
        console.log(`type of events:${e.type}`);
        document.body.style.backgroundColor="blue";
    }
    caption.addEventListener("focus",events);
});


