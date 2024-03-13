const mysql = require('mysql');
const dotenv = require('dotenv');
dotenv.config();
let instance = null;

const connection = mysql.createConnection({
    host: process.env.HOST,
    user: process.env.USERNAME,
    password: process.env.PASSWORD,
    database: process.env.DATABASE,
    port: process.env.DB_PORT
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Connected!');
})

class DBService {
    static getDBServiceInstance() {
        return instance ? instance : new DBService();
    }
    //educationHistory
    async getEducationData() {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "SELECT * FROM educationHistory;";
                connection.query(query, (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })
            return response;
        }
        catch (err) {
            console.log(err);
        }
    }

    async addEducationData(schoolName, schoolYear, concentration, graduated) {
        try {
            const name = schoolName;
            const year = schoolYear;
            const conc = concentration;
            const grad = graduated;
            const response = await new Promise((resolve, reject) => {
                const query = "insert into educationHistory(schoolName, schoolYear, concentration, graduated) values(?,?,?,?);";
                connection.query(query, [name, year, conc, grad], (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })

            return {
                id: response.insertId,
                name: schoolName,
                year: schoolYear,
                concentration: concentration,
                graduated: graduated
            }
        }
        catch (err) {
            console.log(err);
        }
    }
    async updateEducationData(id, schoolName, schoolYear, concentration, graduated) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "UPDATE educationHistory SET schoolName = ?, schoolYear = ?, concentration = ?, graduated = ? WHERE id = ?;";
                connection.query(query, [schoolName, schoolYear, concentration, graduated, id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                })
            })

            return response === 1 ? true : false;
        } catch (error) {
            console.log(error);
            return false;
        }
    }
    async deleteEducationData(id) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "DELETE FROM educationHistory WHERE id = ?;";
                connection.query(query, [id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                }
                )
            })
            return response === 1 ? true : false;
        }
        catch (err) {
            console.log(err);
            return false;
        }
    }


    //experienceHistory
    async getExperienceData() {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "SELECT * FROM workExperience;";
                connection.query(query, (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })
            return response;
        }
        catch (err) {
            console.log(err);
        }
    }

    async addExperienceData(company, position, duties, timeWorked) {
        try {

            const response = await new Promise((resolve, reject) => {
                const query = "insert into workExperience(company, position, duties, timeWorked) values(?,?,?,?);";
                connection.query(query, [company, position, duties, timeWorked], (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })

            return {
                id: response.insertId,
                name: company,
                position: position,
                duties: duties,
                timeWorked: timeWorked
            }
        }
        catch (err) {
            console.log(err);
        }
    }
    async updateExperienceData(id, company, position, duties, timeWorked) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "UPDATE workExperience SET Company = ?, Position = ?, Duties = ?, TimeWorked= ? WHERE id = ?;";
                connection.query(query, [company, position, duties, timeWorked, id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                })
            })

            return response === 1 ? true : false;
        } catch (error) {
            console.log(error);
            return false;
        }
    }
    async deleteExperienceData(id) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "DELETE FROM workExperience WHERE id = ?;";
                connection.query(query, [id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                }
                )
            })
            return response === 1 ? true : false;
        }
        catch (err) {
            console.log(err);
            return false;
        }
    }
    //skills
    async getSkillsData() {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "SELECT * FROM skills;";
                connection.query(query, (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })
            return response;
        }
        catch (err) {
            console.log(err);
        }
    }
    async addSkillsData(name, skillLevel) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "insert into skills(name, skillLevel) values(?,?);";
                connection.query(query, [name, skillLevel], (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            })

            return {
                id: response.insertId,
                name: name,
                skillLevel: skillLevel
            }
        }
        catch (err) {
            console.log(err);
        }
    }
    async updateSkillsData(id, name, skillLevel) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "UPDATE skills SET name = ?, skillLevel = ? WHERE id = ?;";
                connection.query(query, [name, skillLevel, id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                })
            })

            return response === 1 ? true : false;
        } catch (error) {
            console.log(error);
            return false;
        }
    }
    async deleteSkillsData(id) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "DELETE FROM skills WHERE id = ?;";
                connection.query(query, [id], (err, result) => {
                    if (err) reject(new Error(err.message));
                    resolve(result.affectedRows);
                }
                )
            })
            return response === 1 ? true : false;
        }
        catch (err) {
            console.log(err);
            return false;
        }
    }

    async searchByName(name) {
        try {
            const response = await new Promise((resolve, reject) => {
                const query = "SELECT * FROM BudgetData WHERE cardName = ?;";

                connection.query(query, [name], (err, results) => {
                    if (err) reject(new Error(err.message));
                    resolve(results);
                })
            });

            return response;
        } catch (error) {
            console.log(error);
        }
    }
}
module.exports = DBService;