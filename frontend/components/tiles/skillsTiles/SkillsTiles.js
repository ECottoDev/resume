/**
* SkillsTiles.js
*
* @author Edwin Cotto <edtowers1037@gmail.com>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-February-11 initial version
*/

import { addClasses, addEvent, appendChildren, createHeadingText, createParagraph, createSVGButton, createTileContainer } from "../../../../helpers/basicElements.js";

export class SkillsTiles {
    constructor(parentProps, skill, refresh = () => { }) {
        this.parentProps = parentProps;
        this.skill = skill;
        this.refresh = refresh;
        this.view = addClasses(createTileContainer(), 'skillsTiles_view');
        this.setView();
    }
    setView() {
        appendChildren(this.view, [
            addClasses(createHeadingText(this.skill.name, { bold: true }), 'skillsTiles_skillName'),
            addClasses(createParagraph(this.skill.skillLevel), 'skillsTiles_skillLevel'),
        ])
    }
}