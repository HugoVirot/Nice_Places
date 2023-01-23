//****************** test de création de lieu ****************

// test affichage accueil
describe('display Nice Places Home Page', () => {
    it('see Nice Places Home Page', () => {
        cy.visit('http://localhost:8000')
    })
})

// on se connecte et on affiche le formulaire
describe('Login as plain user and show place creation form', () => {
    // connexion en tant qu'utilisateur normal
    // avec le pseudo "utilisateur" (existe de base, inséré via seeder)
    it('login as plain user', () => {
        cy.contains('connexion').click()

        cy.get('input[name=email]').type("utilisateur@test.fr", { force: true })
            .should("have.value", "utilisateur@test.fr")

        cy.get('input[name=password]').type("Azerty88@", { force: true })
            .should("have.value", "Azerty88@")

        cy.get('[type=submit]').click({ force: true })

        cy.url().should('include', '/successmessage')

    })
})

// on le remplit et on le valide
describe('Display the creation form, fill it up and submit it', () => {

    // on accède au formulaire de création de lieu
    it('display homepage and click on the link to show the form', () => {

        cy.url().should('contain', 'http://localhost:8000')

        cy.wait(3000) // attendre deux secondes (temps affichage message succès)

        cy.contains('proposer un lieu').click()
    })

    // on remplit le formulaire de création de lieu
    it('fill up the form and validate', () => {

        cy.get('input[name=nom]').type("Lieu de test", { force: true })
            .should("have.value", "Lieu de test")

        cy.get('textarea').type("superbe lieu pour se promener", { force: true })
            .should("have.value", "superbe lieu pour se promener")

        cy.get('input[name=latitude]').type("46.5235000", { force: true })
            .should("have.value", "46.5235000")

        cy.get('input[name=longitude]').type("-0.7568780", { force: true })
            .should("have.value", "-0.7568780")

        cy.get('select[name=categorie]').select(0, { force: true })
            .should("have.value", 1)

        cy.get('input[name=note]').type("8", { force: true })
            .should("have.value", "8")

        cy.get('input[name=temps]').type("2", { force: true })
            .should("have.value", "2")

        cy.get('select[name=difficulte]').select("sportif", { force: true })
            .should("have.value", "sportif")

        cy.get('select[name=departement]').select(0, { force: true })
            .should("have.value", 1)

        cy.get('input[name=adresse]').type("rue du test", { force: true })
            .should("have.value", "rue du test")

        cy.get('input[name=code_postal]').type("77777", { force: true })
            .should("have.value", "77777")

        cy.get('input[name=ville]').type("Ville Test", { force: true })
            .should("have.value", "Ville Test")

        // une fois que tout est rempli : on valide en cliquant sur le bouton
        cy.get('[type=submit]').click({ force: true })

        // cy.wait(1000) // attendre deux secondes (temps affichage message succès)

        cy.url().should('include', '/SuccessMessage')
    })
})

// vérification de la présence du lieu en base de données et suppression de celui-ci
describe('Check if place is correctly inserted in database and delete it', () => {
    // on vérifie la présence du lieu en bdd
    it('check if place exists in lieus table', function () {
        cy.task('queryDb', `SELECT * FROM lieus ORDER BY id desc LIMIT 1`).then((result) => {
            expect(result[0].nom).to.equal('Lieu de test')
        })
    })

    // on supprime le lieu créé pour pouvoir relancer le test sans problème
    it('Delete the created place', function () {
        cy.task('queryDb', `DELETE FROM lieus ORDER BY id desc LIMIT 1`).then((result) => {
            expect(result.message).to.equal("")
        })
    })
})
