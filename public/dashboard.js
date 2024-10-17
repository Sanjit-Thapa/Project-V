// script for the dashboard
let burgerBtn = document.getElementById("burgerBtn")


burgerBtn.addEventListener("click",(evt)=>
{
    let sidebar = document.getElementById("menu")
        if(sidebar.classList.contains="w-[17%]")
        {
            sidebar.classList.add="w-[4%]"
        }
     
})