//Toggles sub menu
function toggleSubMenu(elementID){   
    let submenu = document.getElementById(elementID);
    submenu.classList.toggle("open");
}

//------------PROFILE PAGE JS--------------

//toggle bio
function toggleBio(){
    let bioOptions = document.getElementById("bio-container");
    let bioBtn = document.getElementById("bio-btn");
    let bio = document.getElementById("bio-display");

    bioOptions.classList.toggle("open");
    bioBtn.classList.toggle("open");
    bio.classList.toggle("open");
}

    //AJAX updates bio
    function updateBio(e){
        e.preventDefault();

        var bio = document.getElementById('bio').value;
        var userID = document.getElementById('userID').value;
        
        //Sends appropriate input to controller
        var action = "updateBio";
        var params = "bio=" + encodeURIComponent(bio) + "&action=" + encodeURIComponent(action)+ "&userID=" + encodeURIComponent(userID);

        var xhr = new XMLHttpRequest();

        xhr.open("POST", '../../controllers/ProfileController.php', true);

        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function(){
            if(this.status == 200){
                //Closes bio editor
                toggleBio();
                //Updates bio to display new text
                var bioText = document.getElementById("bio-display");
                bioText.innerText = bio;
            }
        }
        xhr.send(params);
    }


//Changes submenu for changing cover picture.
function changeCover(){
    let upload = document.getElementById("cover");


    upload.addEventListener("change", function(){
    
    var filename = document.getElementById("cover-name");
    
    var submit = document.getElementById("cover-item-submit");

    filename.innerHTML = upload.files[0].name;

    submit.style.display = "block";
    });
}

//Changes submenu for changing profile picture.
function changeProfile(){
    let upload = document.getElementById("profile");

    upload.addEventListener("change", function(){
    
    var filename = document.getElementById("profile-name");
    
    var submit = document.getElementById("pro-item-submit");

    filename.innerHTML = upload.files[0].name;

    submit.style.display = "block";
    });
}

//-------------POST AND COMMENT JAVASCRIPT-------------------
//AJAX updates content of posts
function updateContent(type,ID, e){

    e.preventDefault();

    //Specified post
    var postEdit = document.getElementById(type+"-editor-"+ID);

    //Value from textarea
    var postContent = postEdit.querySelector("#edit-post-content").value;

    //Action to be done in controller
    var action = "update"+type;

    //Actual post content
    var content = document.getElementById("content_"+ID);

    var params = "content=" + postContent + "&action=" + action + "&ID=" + ID;

    xhr = new XMLHttpRequest();

    xhr.open("POST", "../../controllers/CommonController.php", true);

    xhr.setRequestHeader("content-type", 'application/x-www-form-urlencoded');

    xhr.onload = function(){
        if(this.status == 200){
            //Toggles the editor when complete
            toggleEditor(type,ID);
            //Adds content
            content.innerText = postContent;
        }
    }
    xhr.send(params);
}

//Toggles post editor for specified post or comment
function toggleEditor(type, ID){
    //Uses id of comment or post to get the specific container and editor container
    var post = document.getElementById(type+"_"+ID);

    var postEdit = document.getElementById(type+"-editor-"+ID);

    var content = document.getElementById("content_"+ID);

    // Toggle the visibility of the post editor by changing its display style
    if (postEdit.style.display === 'none' || postEdit.getAttribute("style") == null) {
        postEdit.style.display = 'block'; // Show the post editor
        content.style.display = 'none';
    } else {
        postEdit.style.display = 'none'; // Hide the post editor
        content.style.display = 'block';
    }
}


//----------LOGIN/SIGN UP JS--------------
//----MODAL SIGN UP WINDOW IN LOG IN PAGE----

//Displays popup
function displayPopup(){
    let popup = document.getElementById('popup');
    var container = document.getElementById('blur');
    popup.style.opacity = 1;
    popup.style.visibility = 'visible';
    container.classList.replace('container', 'containerActive');
}

//Removes popup
function removePopup(){
    let popup = document.getElementById('popup');
    var container = document.getElementById('blur');
    popup.style.opacity = '0';
    popup.style.visibility = 'hidden';
    container.classList.replace('containerActive', 'container');
}