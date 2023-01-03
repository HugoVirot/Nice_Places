describe('My First Test', () => {
  it('Visits the Kitchen Sink', () => {
    cy.visit('https://example.cypress.io')
  })
})

describe('My Second Test', () => {
  it('finds the content "type"', () => {
    cy.visit('https://example.cypress.io')

    cy.contains('type')
  })
})

// test affichage accueil
// describe('Nice Places Home Page', () => {
//   it('Visits Nice Places Home Page', () => {
//     cy.visit('http://localhost:8000')
//   })
// })

// test recherche de contenu (mot)
describe('Test carte', () => {
  it('finds the content "Carte"', () => {
    cy.visit('http://localhost:8000')

    cy.contains('carte').click()
  })
})

// describe('My First Test', () => {
//   it('Does not do much!', () => {
//     expect(true).to.equal(false)
//   })
// })
