const { defineConfig } = require('cypress');
const webpackConfig = require('./webpack.mix.js');

//For connecting to SQL Server
const mysql = require('mysql')

function queryTestDb(query, config) {
  // creates a new mysql connection using credentials from cypress.json env's
  const connection = mysql.createConnection(config.env.db)
  // start connection to db
  connection.connect()
  // exec query + disconnect to db as a Promise
  return new Promise((resolve, reject) => {
    connection.query(query, (error, results) => {
      if (error) reject(error)
      else {
        connection.end()
        return resolve(results)
      }
    })
  })
}


module.exports = defineConfig({
  e2e: {
    baseUrl: 'http://localhost:8000',
    setupNodeEvents(on, config) {
      // implement node event listeners here
      // using cy.task() to enable cypress to run SQL queries
      on('task', { queryDb: query => { return queryTestDb(query, config) }, }); //For running sql query
    }
  },

  env: {
    "db": {
      "host": "localhost",
      "user": "root",
      "password": "",
      "database": "nice_places"
    }
  },

  component: {
    devServer: {
      framework: 'vue',
      bundler: 'webpack',
      webpackConfig,
    },
  },
});