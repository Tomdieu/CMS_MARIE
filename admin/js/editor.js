
    // getting the container
    var editor_constrols = document.querySelector('#editor_controls');


    // creating the different controls for the container

    var boldBtn = document.createElement('button');
    boldBtn.innerHTML = '<span class="mdi mdi-format-bold"></span>';
    // boldBtn.i                                                                                                                                                                                                                                                                                                                                                                                                                                                           nnerText ='B';
    var italicBtn = document.createElement('button');
    // italicBtn.innerText ='I';
    italicBtn.innerHTML = '<span class="mdi mdi-format-italic"></span>';
    var underlineBtn = document.createElement('button');
    underlineBtn.innerHTML = '<span class="mdi mdi-format-underline"></span>';

    var justifyLeftBtn = document.createElement('button');
    justifyLeftBtn.innerHTML = '<span class="mdi mdi-format-float-left"></span>';

    var justifyRightBtn = document.createElement('button');
    justifyRightBtn.innerHTML = '<span class="mdi mdi-format-float-right"></span>'
    var justifyBtn = document.createElement('button');
    justifyBtn.innerHTML = '<span class="mdi mdi-format-columns"></span>';
    var centerBtn = document.createElement('button');
    centerBtn.innerHTML = '<span class="mdi mdi-format-float-center"></span>'
    var colorBtn = document.createElement('input');
    colorBtn.setAttribute('type','color')
    var headingsBtn = document.createElement('div');
    headingsBtn.classList.add('controls');
    headingsBtn.style.display = 'flex';
    headingsBtn.style.justifyContent = 'space-between';

    const h1 = document.createElement('button');
    h1.innerHTML = '<span class="mdi mdi-format-header-1"></span>';
    headingsBtn.appendChild(h1);
    const h2 = document.createElement('button');
    h2.innerHTML = '<span class="mdi mdi-format-header-2"></span>';
    headingsBtn.appendChild(h2);
    const h3 = document.createElement('button');
    h3.innerHTML = '<span class="mdi mdi-format-header-3"></span>';
    headingsBtn.appendChild(h3);
    const h4 = document.createElement('button');
    h4.innerHTML = '<span class="mdi mdi-format-header-4"></span>';
    headingsBtn.appendChild(h4);
    const h5 = document.createElement('button');
    h5.innerHTML = '<span class="mdi mdi-format-header-5"></span>';
    headingsBtn.appendChild(h5);
    const h6 = document.createElement('button');
    h6.innerHTML = '<span class="mdi mdi-format-header-6"></span>';
    headingsBtn.appendChild(h6);

    headingsBtn.childNodes.forEach((ch)=>{
        ch.classList.add('ctrl')
    })

    const controls = [boldBtn,italicBtn,underlineBtn,justifyBtn,justifyLeftBtn,justifyRightBtn,centerBtn,colorBtn,headingsBtn];

    boldBtn.addEventListener('click',()=>{
        document.execCommand('bold');
    })

    italicBtn.addEventListener('click',()=>{
        document.execCommand('italic')
    })

    underlineBtn.addEventListener('click',()=>{
        document.execCommand('underline')
    })

    justifyBtn.addEventListener('click',()=>{
        document.execCommand('justifyFull',false,'');
    })

    justifyLeftBtn.addEventListener('click',()=>{
        document.execCommand('justifyLeft',false,'')
    })

    justifyRightBtn.addEventListener('click',()=>{
        document.execCommand('justifyRight',false,'')
    })

    centerBtn.addEventListener('click',()=>{
        document.execCommand('justifyCenter',false,'')
    })

    colorBtn.addEventListener('input',()=>{
        document.execCommand('foreColor',false,colorBtn.value)
    })

    h1.addEventListener('click',()=>{
        document.execCommand('formatBlock',false,'H1');
    })

    h2.addEventListener('click',()=>{
        document.execCommand('formatBlock',false,'H2');
    })
    h3.addEventListener('click',()=>{
        document.execCommand('formatBlock',false,'H3');
    })
    h4.addEventListener('click',()=>{
        document.execCommand('formatBlock',false,'H4');
    })
    h5.addEventListener('click',()=>{
        console.log(h5)
        document.execCommand('formatBlock',false,'H5');
    })
    h6.addEventListener('click',()=>{
        document.execCommand('formatBlock',false,'H6');
    })


    // 
    boldBtn.classList.add('ctrl');
    italicBtn.classList.add('ctrl');
    underlineBtn.classList.add('ctrl');
    justifyLeftBtn.classList.add('ctrl');
    justifyRightBtn.classList.add('ctrl');
    centerBtn.classList.add('ctrl');
    colorBtn.classList.add('ctrl');
    headingsBtn.classList.add('ctrl');


    controls.map((ele)=>{
        editor_constrols.appendChild(ele);
    })




