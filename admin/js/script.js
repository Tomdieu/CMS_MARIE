function $(selector){
    var self = {
        element:document.querySelectorAll(selector),
        show:()=>{
            self.element.forEach(ele => {
                ele.style.display = 'block';
            });
        },
        hide:()=>{
            self.element.forEach(ele=>{
                ele.style.display = 'none';
            })
        },
        text:(text)=>{
            self.element.forEach(e=>{
                e.innerText = text;
            })
        },
        on:(event,callback)=>{
            self.element.forEach(ele=>{
                ele.addEventListener(event,callback);
            })
        }
    }
    return self;
}
