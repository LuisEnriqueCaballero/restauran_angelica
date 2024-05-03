// variables
const contenido_menus=document.querySelectorAll('.contenido_menu_link');
let list_menus=document.querySelectorAll('.list_menu-click');
let iconbar=document.querySelector('.icon_burger')
let menu=document.querySelector('.menu');
let contenido=document.querySelector('.contenido');
let sub_menus=document.querySelectorAll('.sub_nav');
let logo_usuario=document.querySelector('.logo_usuario');
let logo_menu=document.querySelector('.logo_menu');

// evemtos


   contenido_menus.forEach(contenido_menu=>{
    contenido_menu.addEventListener('click',function(){
        document.querySelector('.activo').classList.remove('activo');
        contenido_menu.classList.add('activo');
    })
   })

   contenido_menus.forEach(list_menu=>{
    list_menu.addEventListener('click', function(e){
        const elemento=list_menu.nextElementSibling;
        
        console.log(elemento)
        let altura=0;
        if(elemento.clientHeight === 0){
            altura= elemento.scrollHeight; 
            
        }
        elemento.style.height=`${altura}px`;
    })
   })

   iconbar.addEventListener('click',function(){
    let ancho=60;
    if(menu.clientWidth === 300){
        menu.style.zIndex = "-100";
        menu.style.width=`${ancho}px`;
        contenido.style.width=`calc(100% - ${ancho}px)`
        logo_usuario.querySelector('img').style.width=`60px`
        logo_usuario.querySelector('img').style.height=`60px`
        logo_menu.querySelector('img').style.width=`60px`
        logo_menu.querySelector('img').style.height=`60px`
        logo_menu.querySelector('a span').style.display='none'
        logo_usuario.querySelector('.roll').style.display='none'
        logo_usuario.querySelector('.nombre').style.display='none'
        contenido_menus.forEach(contenido_menu=>{
            contenido_menu.style.visibility='hidden';
            contenido_menu.querySelector('.iconos_principal').style.visibility='visible';
        })
        sub_menus.forEach((sub_menu) => {
         if(sub_menu.clientHeight >0){
          sub_menu.style.height=`0px`;
         }
        })
        return;
    }
    menu.style.zIndex = "0";
    menu.style.width=`300px`;
    contenido.style.width=`calc(100% - 300px)`;
    contenido_menus.forEach(contenido_menu=>{
        contenido_menu.style.visibility='visible';
    })
    logo_usuario.querySelector('img').style.width=`80px`
        logo_usuario.querySelector('img').style.height=`80px`
        logo_menu.querySelector('img').style.width=`120px`
        logo_menu.querySelector('img').style.height=`120px`
        logo_menu.querySelector('a span').style.display=''
        logo_usuario.querySelector('.roll').style.display=''
        logo_usuario.querySelector('.nombre').style.display=''
   })

// let contenidos=document.querySelectorAll('.contenido_menu_link')
// contenidos.forEach((contenido) => {
//       contenido.addEventListener('click',function(e){
//         contenido.classList.toggle('contenido_menu_link--click')
//       })
// })



// let activos=document.querySelectorAll('.contenido_menu_link .link_menu');
// activos.forEach(activo=>{
//     activo.addEventListener('click',()=>{
//         document.querySelector('.activo').classList.remove('activo');
//         activo.classList.add('activo');
//     })
// })
// let icon_burge=document.querySelector('.icon_burger');
// let menu=document.querySelector('.menu');
// let contenido_panel=document.querySelector('.contenido');
// let enlace_logo=document.querySelector('.enlace_menu img')
// let enlace_span=document.querySelector('.enlace_menu span')
// let contenidose=document.querySelectorAll('.contenido_menu_link')
// let datos=document.querySelector('.dato_usuario');
// let ancho_menu=80;
// let ancho_original=300;
// icon_burge.addEventListener('click', function(){
//     if(menu.clientWidth===300){
//         menu.style.width=`${ancho_menu}px`
//         menu.style.zIndex = "-100";
//         contenido_panel.style.width=`calc(100% - ${ancho_menu}px)`
//         enlace_logo.style.width='80px' 
//         enlace_logo.style.height='80px' 
//         enlace_span.style.display='none' 
//         contenidose.forEach((contenido) => {
//             contenido.classList.add('contenido_menu_link--click')
//             contenido.style.visibility = 'hidden';
//             contenido.querySelector('.iconos_principal').style.visibility='visible';
            
            
//         })
//         datos.style.display='none'
//     }else{
//         menu.style.width=`${ancho_original}px`
//         contenido_panel.style.width=`calc(100% - ${ancho_original}px)`
//         enlace_logo.style.width='120px' 
//         enlace_logo.style.height='120px'
//         menu.style.zIndex = "100";
//          enlace_span.style.display=''
//          contenidose.forEach((contenido) => {
//             contenido.classList.remove('contenido_menu_link--click')
//             contenido.style.visibility = 'visible';
            
//         })   
//         datos.style.display='flex'
//     }
// })
