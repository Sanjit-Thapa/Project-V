// script for the dashboard
let burgerBtn = document.getElementById("burgerBtn")

burgerBtn.addEventListener("click", (evt) => {
    let sidebar = document.getElementById("menu");
    let labels = document.getElementsByClassName("label");

    // If the sidebar is currently 17% wide
    if (sidebar.classList.contains("w-[17%]")) {
        sidebar.style.width = "5%";

        // Hide labels
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.display = "none";
        }

        // Remove 'w-[17%]' class and add 'w-[5%]' class
        sidebar.classList.remove("w-[17%]");
        sidebar.classList.add("w-[5%]");
    } 
    // If the sidebar is currently 5% wide
    else if (sidebar.classList.contains("w-[5%]")) {
        sidebar.style.width = "17%";

        // Show labels as flex items
        for (let i = 0; i < labels.length; i++) {
            labels[i].style.display = "inline"; // Use flex here to keep the flexbox layout
        }

        // Remove 'w-[5%]' class and add 'w-[17%]' class
        sidebar.classList.remove("w-[5%]");
        sidebar.classList.add("w-[17%]");
    }
});


let profile = document.getElementById("profile");
let profileCard = document.getElementById("profileCard");
let profilePicture = document.getElementById("profilePicture");
let changeProfile = document.getElementById("changeProfile");
let exit = document.getElementById("exit");

// let isOpen = false; // To track the state

// profile.addEventListener("click", (event) => {
//     event.stopPropagation(); // Prevent event from bubbling up
//     profileCard.classList.toggle("hidden");
//     profileCard.classList.toggle("show");
//     isOpen = !isOpen; // Toggle the state
// });

profile.addEventListener("click", (evt) => {
    evt.preventDefault();
   
    if (profileCard.classList.contains("hidden")) {
        profileCard.classList.remove("hidden");
        profileCard.style.display = "flex";  // Show the profile card
    } else {
        profileCard.classList.add("hidden");
        profileCard.style.display = "none";  // Hide the profile card
    }
});


document.addEventListener('click',()=>{
   if(profileCard.style.display==="flex")
   {
        profileCard.style.display="mone";
   }
})




// Close the profile card when clicking outside

//will be building this too

// this is the another part

changeProfile.addEventListener('click',()=>{
  
    if(profilePicture.classList.contains("hidden"))
    {
        profilePicture.style.display="flex";
    }
   
})


//making the exit for the profile picture card

exit.addEventListener("click",(evt)=>{
    let val = evt.target.id;
    // let profilePicture = document.getElementById("profilePicture");
    if(profilePicture.classList.contains("flex")){
        // profilePicture.classList.remove("flex");
        profilePicture.style.display = "none";
      
    }
   
})

//for changing the options of the other Display options

function options() {
    let ArtOptions = document.querySelector(".display i");
  
    let Banner = document.querySelector(".Banner");
    
    let down;
    if (ArtOptions.classList.contains("fa-chevron-right")) {
        ArtOptions.classList.remove("fa-chevron-right");
        ArtOptions.classList.add("fa-chevron-down");

        down =true;
        
    } else {
        ArtOptions.classList.remove("fa-chevron-down");
        ArtOptions.classList.add("fa-chevron-right");
        
        down = false;
    }

    if(down)
    {
    
        Banner.classList.remove("hidden");
        Banner.classList.add("visible");
    }
    else{
        Banner.classList.remove("visible");
        Banner.classList.add("hidden");
    }


}



