describe('empty spec', () => {
  it('passes', () => {
    cy.visit('https://example.cypress.io')
  })
})

const login = require("../../fixtures/login");

context("Login and buy stuff", () => {
  before(() => {
    cy.visit('/');
  });

  describe("Attempt to sign in", () => {
    it('should have link to sign in', () => {
      cy.get('[data-cy=signInBtn]').click();
    });

    it("Type data and submit form", () => {
      cy.get('[data-cy=email]')
        .type(login.email)
        .should("have.value", login.email);

      cy.get('[data-cy=password]')
        .type(login.password)
        .should("have.value", login.password);

      cy.get('[data-cy=submit]').click();
    });
  });

  describe("Buy stuff process", () => {
    it('url should be /shop', () => {
      cy.url().should("include", "/shop");
    });

    it('check the cart to be zero', () => {
      cy.get('[data-cy=cart]').contains(0);
    })

    it('click on stuff 2', () => {
      cy.get('[data-cy=stuff-1]').contains('Add');
      cy.get('[data-cy=stuff-1]').click();
    });

    it('increment the cart', () => {
      cy.get('[data-cy=cart]').contains(1);
    })

    it('click on cart', () => {
      cy.get('[data-cy=cart]').click();
    });

    it('redirect to cart view', () => {
      cy.url().should("include", "/cart");
    });

    it('purchase stuff and see confirm message', () => {
      cy.get('[data-cy=submit]').contains('PURCHASE');
      cy.get('[data-cy=submit]').click();
      cy.get('[data-cy=success]').contains('Thank you for your purchase');
    });
  })
});
