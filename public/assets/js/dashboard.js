!function(){"use strict";class SidebarCollapser{options={limiter:640,activeClass:"collapsed",elements:{toggler:document.getElementById("sidebarToggler"),sidebar:document.getElementById("sidebar")}};constructor(options={}){this.options=Object.assign(this.options,options),this.options.elements.toggler&&(this.options.elements.toggler.onclick=e=>{e.preventDefault(),this.toggleCollapse()})}get isCollapse(){return!0===this.options.elements.sidebar?.classList.contains("collapsed")}get shouldCollapse(){return window.innerWidth<this.options.limiter}toggleCollapse(){let{sidebar:sidebar}=this.options.elements;this.isCollapse?sidebar?.classList.remove("collapsed"):sidebar?.classList.add("collapsed")}}class SidebarFixer{options={limiter:640,elements:{sidebar:document.getElementById("sidebar"),toggler:document.getElementById("sidebarToggler")}};constructor(options={}){this.options=Object.assign(this.options,options),window.onload=window.onresize=()=>{this.toggleFixed()},window.onclick=e=>{if(this.options.elements.sidebar&&!this.isCollapse&&this.isFixed){e.preventDefault();let target=e.target,sidebarTarget=!0===this.options.elements.sidebar?.contains(target),togglerTarget=!0===this.options.elements.toggler?.contains(target);sidebarTarget||togglerTarget||this.options.elements.toggler?.click()}}}get isFixed(){return!0===this.options.elements.sidebar?.classList.contains("fixed")}get isCollapse(){return!0===this.options.elements.sidebar?.classList.contains("collapsed")}get shouldFixed(){return window.innerWidth<this.options.limiter}toggleFixed(){const{sidebar:sidebar}=this.options.elements;!this.isFixed&&this.shouldFixed?sidebar?.classList.add("fixed"):this.isFixed&&!this.shouldFixed&&sidebar?.classList.remove("fixed")}}class Sidebar{constructor(){new SidebarCollapser,new SidebarFixer}}new Sidebar}();