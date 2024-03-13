/**
* EducationHistory.js
*
* @author Edwin Cotto <edtowers1037@gmail.com>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-February-10 initial version
*/


import { addClasses, addEvent, appendChildren, createElementContainer, createHeadingText, createSVGButton, createScrollArea, detachChildren, sortArrayOfObj } from "../../../helpers/basicElements.js";
import { EducationTiles } from "../../components/tiles/educationTiles/EducationTiles.js";
import { getEducationData } from "../../dataCalls.js";

export class EducationHistory {
    constructor(parentProps) {
        this.parentProps = parentProps;
        this.view = addClasses(createElementContainer('all'), 'educationHistory_view');
        this.fetch();

    }
    async fetch() {
        this.educationData = await getEducationData();
        this.educationData.sort(sortArrayOfObj('-schoolYear'));
        this.setView();
    }
    setView() {
        appendChildren(this.view, [
            addClasses(createHeadingText('Education', { bold: true }), 'educationHistory_heading'),
            appendChildren(addClasses(createScrollArea(), 'resumeView_scrollArea'), [
                this.educationData.map((entry) => {
                    return addClasses(new EducationTiles(this.parentProps, entry, () => { detachChildren(this.view); this.fetch(); }).view, 'resumeView_educationTile');
                })]
            ),
        ])
    }
}