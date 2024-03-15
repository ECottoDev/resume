/**
* main.js
*
* @author Edwin Cotto <edtowers1037@gmail.com>
* @copyright Edwin Cotto, All rights reserved.
*
* @version 2024-January-28 initial version
*/
const express = require('express');
const app = express();
const cors = require('cors');
const dotenv = require('dotenv');
dotenv.config();

const dbService = require('./service/database');
const { Index } = require('./frontend');

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: false }));

const db = dbService.getDBServiceInstance() //Education database connections
app.post('/addEducationData', (req, res) => {
    const { schoolName, schoolYear, concentration, graduated } = req.body;
    const result = db.addEducationData(schoolName, schoolYear, concentration, graduated);
    result
        .then(data => res.json({ success: true }))
        .catch(err => console.log(err));
});

app.get('/getEducationData', (req, res) => {
    const result = db.getEducationData();
    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
});
app.patch('/updateEducationData', (request, response) => {
    const { id, schoolName, schoolYear, concentration, graduated } = request.body;
    const result = db.updateEducationData(id, schoolName, schoolYear, concentration, graduated);

    result
        .then(data => response.json({ success: data }))
        .catch(err => console.log(err));
});
app.delete('/deleteEducationData', (req, res) => {
    const { id } = req.body;
    const result = db.deleteEducationData(id);
    result
        .then(data => res.json({ success: data }))
        .catch(err => console.log(err));
});

//Experience database connections
app.post('/addExperienceData', (req, res) => {
    const { company, position, duties, timeWorked } = req.body;
    const result = db.addExperienceData(company, position, duties, timeWorked);
    result
        .then(data => res.json({ success: true }))
        .catch(err => console.log(err));
});

app.get('/getExperienceData', (req, res) => {
    const result = db.getExperienceData();
    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
}
);
app.patch('/updateExperienceData', (request, response) => {
    const { id, company, position, duties, timeWorked } = request.body;
    const result = db.updateExperienceData(id, company, position, duties, timeWorked);

    result
        .then(data => response.json({ success: data }))
        .catch(err => console.log(err));
});
app.delete('/deleteExperienceData', (req, res) => {
    const { id } = req.body;
    const result = db.deleteExperienceData(id);
    result
        .then(data => res.json({ success: data }))
        .catch(err => console.log(err));
});

//Skills database connections
app.post('/addSkillsData', (req, res) => {
    const { name, skillLevel } = req.body;
    const result = db.addSkillsData(name, skillLevel);
    result
        .then(data => res.json({ success: true }))
        .catch(err => console.log(err));
});

app.get('/getSkillsData', (req, res) => {
    const result = db.getSkillsData();
    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
});
app.patch('/updateSkillsData', (request, response) => {
    const { id, name, skillLevel } = request.body;
    const result = db.updateSkillsData(id, name, skillLevel);

    result
        .then(data => response.json({ success: data }))
        .catch(err => console.log(err));
});

app.delete('/deleteSkillsData', (req, res) => {
    const { id } = req.body;
    const result = db.deleteSkillsData(id);
    result
        .then(data => res.json({ success: data }))
        .catch(err => console.log(err));
});
//read

app.get('/getAll', (req, res) => {
    const result = db.getAllData();

    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
}
);

app.get('/getBudget', (req, res) => {
    const result = db.getBudget();

    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
}
);

app.get('/getBank', (req, res) => {
    const result = db.getBank();

    result
        .then(data => res.json({ data: data }))
        .catch(err => console.log(err));
}
);



//delete

// app.delete('/api/delete/:id', (req, res) => {
//     const id = req.params.id;
//     const sqlDelete = "DELETE FROM contacts WHERE id = ?";
//     db.query(sqlDelete, id, (err, result) => {
//         if (err) console.log(err);
//     });
// }
// );

app.listen(process.env.PORT, () => {
    console.log("running on port 5500");
    new Index().view;
})