// ****************** TEST D'INSCRIPTION ET DE CONNEXION ******************

// import du userStore pour le tester 
// import { createTestingPinia } from '@pinia/testing'
// import { useUserStore } from '../../resources/js/stores/userStore'

// const userStore = useUserStore()

// test affichage accueil
describe('display Nice Places Home Page', () => {
  it('see Nice Places Home Page', () => {
    cy.visit('http://localhost:8000')
  })
})


// **************************test d'inscription*****************************

describe('attempt to sign up', () => {

  // clic sur le lien pour afficher le formulaire
  it('should have link to sign up', () => {
    cy.contains('inscription').click()
  })

  // remplissage du formulaire : politique de conf. (checkbox), pseudo, email, mdp + confirmation, département
  it("type data and submit form", () => {

    cy.get('[type=checkbox]').check({ force: true })
      .should('be.checked')

    // on vérifie que le bouton valider est devenu visible après avoir accepté la politique de conf. 
    cy.get('[type=submit]').should('be.visible')

    cy.get('input[name=pseudo]').type("utilisateurTest", { force: true })
      .should("have.value", "utilisateurTest")

    cy.get('input[name=email]').type("utilisateurTest@test.fr", { force: true })
      .should("have.value", "utilisateurTest@test.fr")

    cy.get('input[name=password]').type("Azerty88@", { force: true })
      .should("have.value", "Azerty88@")

    cy.get('input[name=password_confirmation]').type("Azerty88@", { force: true })
      .should("have.value", "Azerty88@")

    cy.get('select').select('79 - Deux Sèvres', { force: true })
      .should("have.value", 80)

    // une fois que tout est rempli : on valide en cliquant sur le bouton
    cy.get('[type=submit]').click({ force: true })

    // on vérifie que le message de succès s'affiche (composant SuccessMessage)
    cy.url().should('include', '/successmessage')

  });
})


// ************************** test de connexion *****************************

describe('attempt to sign in', () => {

  // clic sur le lien pour afficher le formulaire
  it('should have link to sign in', () => {
    cy.contains('connexion').click()
  })

  // remplissage du formulaire : email + mdp
  it("type data and submit form", () => {

    cy.get('input[name=email]').type("utilisateurTest@test.fr", { force: true })
      .should("have.value", "utilisateurTest@test.fr")

    cy.get('input[name=password]').type("Azerty88@", { force: true })
      .should("have.value", "Azerty88@")

    // une fois que tout est rempli : on valide en cliquant sur le bouton
    cy.get('[type=submit]').click({ force: true })

    // on vérifie que le message de succès s'affiche (composant SuccessMessage)
    cy.url().should('include', '/successmessage')
  });

  // on supprime l'utilisateur créé pour pouvoir relancer le test sans problème
  it('Delete the created user', function () {
    cy.task('queryDb', `DELETE FROM users ORDER BY id desc LIMIT 1`).then((result) => {
      expect(result.message).to.equal("")
    })
  })
})



// ************************** test de suppression de compte *****************************

// describe('attempt to delete account', () => {

//   // clic sur le lien pour afficher le formulaire
//   it('should have link to access account settings', () => {
//     cy.contains('mon compte').click({ force: true })
//   })

//   // suppression du compte
//   it("delete account", () => {
//     // on valide en cliquant sur le bouton
//     cy.get('.btn-danger').click({ force: true })

//     // // on supprime l'utilisateur après l'inscription (pour pouvoir relancer le test)
//     // pb : transmettre le token reçu à la connexion avec la requête de suppression

//     // cy.request('DELETE', 'http://localhost:8000/api/users/10')

//     // on vérifie que le message de succès s'affiche (composant SuccessMessage)
//     cy.url().should('include', '/successmessage')

//   });
// })


