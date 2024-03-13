// Purpose: This file contains all the data calls to the backend server.
//eduction data
export async function getEducationData() {
    var data = await fetch('http://localhost:5500/getEducationData');
    data = await data.json();
    data = data.data;

    return data;
}
export async function addEducationData(schoolName, schoolYear, concentration, graduated) {
    const response = await fetch('http://localhost:5500/addEducationData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ schoolName, schoolYear, concentration, graduated })
    });

    return response.json();
}
export async function updateEducationData(id, schoolName, schoolYear, concentration, graduated) {
    const response = await fetch('http://localhost:5500/updateEducationData', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, schoolName, schoolYear, concentration, graduated })
    });

    return response.json();
}
export async function deleteEducationData(id) {
    const response = await fetch('http://localhost:5500/deleteEducationData', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    return response.json();
}

//experience data
export async function getExperienceData() {
    var data = await fetch('http://localhost:5500/getExperienceData');
    data = await data.json();
    data = data.data;

    return data;
}
export async function addExperienceData(company, position, duties, timeWorked) {
    const response = await fetch('http://localhost:5500/addExperienceData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ company, position, duties, timeWorked })
    });

    return response.json();
}

export async function updateExperienceData(id, company, position, duties, timeWorked) {
    const response = await fetch('http://localhost:5500/updateExperienceData', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, company, position, duties, timeWorked })
    });

    return response.json();
}

export async function deleteExperienceData(id) {
    const response = await fetch('http://localhost:5500/deleteExperienceData', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    return response.json();
}

//skills data
export async function getSkillsData() {
    var data = await fetch('http://localhost:5500/getSkillsData');
    data = await data.json();
    data = data.data;

    return data;
}
export async function addSkillsData(name, skillLevel) {
    const response = await fetch('http://localhost:5500/addSkillsData', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name, skillLevel })
    });

    return response.json();
}
export async function deleteSkillsData(id) {
    const response = await fetch('http://localhost:5500/deleteSkillsData', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id })
    });

    return response.json();
}
export async function updateSkillsData(id, name, skillLevel) {
    const response = await fetch('http://localhost:5500/updateSkillsData', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id, name, skillLevel })
    });

    return response.json();
}
