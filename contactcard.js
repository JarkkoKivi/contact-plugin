const iconWrappers = document.querySelectorAll('div.stone-contact-info div.icon-wrapper'); //Yhteystieto ikonin wrapperi
const moreArrow = document.querySelectorAll('div.icon-down-arrow-wrapper'); // lisätietoja nuoli
const computerIcon = document.querySelectorAll('div#contact-card-computer-icon'); // etävastaanotto symboli



document.addEventListener("DOMContentLoaded", function(){
    //....



yhteystiedotIconinKuuntelijat = () => {

    for (i=0; i < iconWrappers.length; i++) {
        iconWrappers[i].addEventListener('mouseover', e => {
            e.currentTarget.firstElementChild.style.visibility = "visible";
            e.currentTarget.children[1].style.color = "#fff";
            e.currentTarget.firstElementChild.firstElementChild.style.opacity = "1";
            e.currentTarget.firstElementChild.style.opacity = "1";
        });
        iconWrappers[i].addEventListener('mouseout', e => {
            e.currentTarget.firstElementChild.style.visibility = "hidden";
            e.currentTarget.children[1].style.color = "#88b54a";
            e.currentTarget.firstElementChild.firstElementChild.style.opacity = "0";
            e.currentTarget.firstElementChild.style.opacity = "0";
        });
    }

    if(computerIcon.length > 0){
       
        for (i=0; i < computerIcon.length; i++) {
            computerIcon[i].addEventListener('mouseout', e => {
                    e.currentTarget.firstElementChild.style.visibility = "hidden";
                    e.currentTarget.children[1].style.color = "#88b54a";
                    e.currentTarget.firstElementChild.firstElementChild.style.opacity = "0";
                    e.currentTarget.firstElementChild.style.opacity = "0";

                });

            computerIcon[i].addEventListener('mouseover', e => {
                    e.currentTarget.firstElementChild.style.visibility = "visible";
                    e.currentTarget.children[1].style.color = "#fff";
                    e.currentTarget.firstElementChild.firstElementChild.style.opacity = "1";
                    e.currentTarget.firstElementChild.style.opacity = "1";
                });
                
            } 
        }
    }



yhteystiedotIconinKlikkiKuuntelijat = () => {

    for (i=0; i < iconWrappers.length; i++) {
        iconWrappers[i].addEventListener('click', e => {
            if (e.currentTarget.firstElementChild.style.visibility === "visible"){
                e.currentTarget.firstElementChild.style.visibility = "hidden";
                e.currentTarget.children[1].style.color = "#88b54a";
                e.currentTarget.style.backgroundColor = "#fff";
               // computerIcon.style.backgroundColor = ""
                e.currentTarget.firstElementChild.firstElementChild.style.opacity = "0";
                e.currentTarget.firstElementChild.style.opacity = "0";
            } else {
                e.currentTarget.firstElementChild.style.visibility = "visible";
                e.currentTarget.children[1].style.color = "#fff";
                e.currentTarget.style.backgroundColor = "#88b54a";
               // computerIcon.style.backgroundColor = ""
                e.currentTarget.firstElementChild.firstElementChild.style.opacity = "1";
                e.currentTarget.firstElementChild.style.opacity = "1";
            }
            
        });
     
    }

    if(computerIcon.length > 0){
       
        for (i=0; i < computerIcon.length; i++) {
            computerIcon[i].addEventListener('click', e => {

                if (e.currentTarget.firstElementChild.style.visibility === "visible"){
                    e.currentTarget.firstElementChild.style.visibility = "hidden";
                    e.currentTarget.children[1].style.color = "#88b54a";
                    e.currentTarget.firstElementChild.firstElementChild.style.opacity = "0";
                e.currentTarget.firstElementChild.style.opacity = "0";

                } else {
                    e.currentTarget.firstElementChild.style.visibility = "visible";
                    e.currentTarget.children[1].style.color = "#fff";
                    e.currentTarget.firstElementChild.firstElementChild.style.opacity = "1";
                e.currentTarget.firstElementChild.style.opacity = "1";
                }
                
            } )
        }
    }

}




//yhteystiedotIconinKlikkiKuuntelijat();

tarkastaleveys = () => {      
    let isMobile = ('ontouchstart' in document.documentElement && /mobi/i.test(navigator.userAgent));
    if (isMobile) {
        yhteystiedotIconinKlikkiKuuntelijat();
    } else {
        yhteystiedotIconinKuuntelijat();
    }
 }

 tarkastaleveys()


alanuolikuuntelijat = () => {
    for (i=0; i < moreArrow.length; i++) {
        moreArrow[i].addEventListener('click', e => {
            if(e.currentTarget.parentElement.style.height === "404px" ){
                e.currentTarget.parentElement.style.height = "214px";
                e.currentTarget.parentElement.children[4].style.visibility = "hidden";
                e.currentTarget.parentElement.children[4].style.height = "0";
                e.currentTarget.firstElementChild.style.transform = "rotate(0)"
                
            } else {
                e.currentTarget.parentElement.style.height = "404px";
                e.currentTarget.parentElement.children[4].style.visibility = "visible";
                e.currentTarget.parentElement.children[4].style.height = "200px";
                e.currentTarget.firstElementChild.style.transform = "rotate(-180deg)"
            }
            
        });
    }
}

alanuolikuuntelijat();





});

