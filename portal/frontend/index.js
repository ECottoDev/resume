
import { addClasses, addEvent, appendChildren, createButton, createElementContainer, createHeadingText, createImg, createSVG, createSVGButton, createScrollArea, detachChildren, getEmptyMessage, getHttpRequest, getURLParam, navigate, parseRequestURL, postHttpRequest } from "../helpers/basicElements.js";
import { routes } from "../helpers/router.js";
import { DisplayBox } from "./components/displayBox/DisplayBox.js";
import { NavigationBar } from "./containers/navigationBar/NavigationBar.js";
import { BrandView } from "./views/brandView/BrandView.js";
import { ResumeView } from "./views/resumeView/ResumeView.js";


window.onload = async () => { appendChildren(document.getElementById('root'), [new Index().view]); }

export class Index {
    constructor() {
        window.onhashchange = () => { this.setNavState() };
        const root = document.getElementById('root');
        this.displayBox = new DisplayBox(root);
        this.setNavObj();
        this.setAppProps();
        this.container = addClasses(createScrollArea(), 'index_container');
        this.view = addClasses(createElementContainer(), 'index_view');
        this.setView();
        
    }
    setAppProps() {
        const root = document.getElementById('root');
        //if any problems arise with the appProps, add {}, before the swirly brackets
        this.appProps = Object.assign(
            {
            displayBox: this.displayBox.display,
            setNavState: this.setNavState.bind(this),
            showMsg: () => { console.log('display showMessage'); }
        });
    }
    async setView() {
        appendChildren(detachChildren(this.view), [
            appendChildren(addClasses(createElementContainer(), 'index_navBarContainer'), [
                addEvent(addClasses(createSVGButton('portal/frontend/assets/icons/lucifer.svg'), 'index_lucifer'), () => { this.setNavState(routes.HOME_VIEW); }),
                this.navBar = addClasses(new NavigationBar(this.appProps).view, 'index_navBar'),
                addClasses(createHeadingText('Edwin Cotto Resume', { bold: true }), 'index_heading'),
            ]),
            this.container,
        ]);
        this.setNavState(this.navState, this.setParams());
    }
    /**
     * helps to set the navigation object and move from pages
     */
    setNavObj() {
        this.navigation = {
            [routes.HOME_VIEW]: () => new ResumeView(this.appProps).view,
            [routes.BRAND_VIEW]: () => new BrandView(this.appProps).view,
        }
    }
    /**
     * helps to direct the user to another page
     * @param {*} hash 
     * @param {*} params (default = false) 
     */
    async setNavState(hash = '', params = false) {
        hash && navigate(hash, params);
        this.navState = parseRequestURL().split('?')[0];
        if (this.navState == '' || this.navState == '#/' || this.navState == '/' || !this.navigation[this.navState]) {
            this.navState = routes.HOME_VIEW;
            navigate(this.navState);
        }
        const navView = this.navigation[this.navState] ? this.navigation[this.navState]() : false;
        (navView && this.navigation[this.navState]) && appendChildren(detachChildren(this.container), navView);
    }
    /**
     * helps to get the params to the url
     */
    setParams() {
        const URLParams = getURLParam();
        return URLParams.success ? URLParams.urlParam : false;
    }

}

