/**
 * Created by SalmonWitcher on 2016-12-06.
 */

var gs={};

function init() {
    gs.submitButton = document.getElementById("submitButton");
    addEvent(gs.submitButton,"click",activateForm);
}

//reliable event handling
function addEvent(obj, type, fn){
    if(obj.addEventListener){
        obj.addEventListener(type, fn, false);
    }
    else if(obj.attachEvent){
        obj.attachEvent("on"+type, fn);
    }
}

function activateForm(){
    gs.formReview = document.getElementById("reviewing");
    gs.formReview.style.display = "block";
    gs.submitButton.style.display = "none";
}



window.onload = init;