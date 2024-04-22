describe('template spec', () => {
  it('passes', () => {
    cy.visit('http://localhost:8000/login')

    // Assert that the page contains a specific text
    cy.contains('Talleres Lebron').should('be.visible')

    cy.get('input[name="email"]').type('test@example.com');
    cy.get('input[name="email"]').should('have.value', 'test@example.com');
  })
})