/**
* EducationTiles.js
*
* @author Edwin Cotto <edtowers1037@gmail.com>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-February-05 initial version
*/

import { addClasses, addEvent, appendChildren, createButton, createHeadingText, createParagraph, createSVGButton, createTileContainer } from "../../../../helpers/basicElements.js";

export class EducationTiles {
    constructor(parentProps, educationEntry, refresh = () => { }) {
        this.parentProps = parentProps;
        this.educationEntry = educationEntry;
        this.refresh = refresh;
        this.view = addClasses(createTileContainer(), 'educationTiles_view');
        this.setView()
    }
    setView() {
        appendChildren(this.view, [
            addClasses(createHeadingText(this.educationEntry.schoolName), 'educationTiles_schoolName'),
            addClasses(createParagraph(this.educationEntry.schoolYear), 'educationTiles_schoolYear'),
            addClasses(createParagraph(this.educationEntry.concentration), 'educationTiles_concentration'),
            this.educationEntry.graduated ? addClasses(createParagraph('Graduated', { bold: true }), 'educationTiles_graduated') : addClasses(createParagraph('Not Graduated', { bold: true }), 'educationTiles_graduated'),
            
        ])
    }
}