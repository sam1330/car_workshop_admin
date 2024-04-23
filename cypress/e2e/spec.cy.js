describe('template spec', () => {
  it('It should login the app', () => {
    cy.visit('http://localhost:8000/login')

    // Assert that the page contains a specific text
    cy.contains('Talleres Lebron').should('be.visible')

    cy.get('input[name="email"]').type('admin@gmail.com');
    cy.get('input[name="password"]').type('password');

    cy.get('button[id="btn-login"]').click();

    cy.url().should('include', '/admin');
  });

  it('It should create an employee', () => {
    cy.visit('http://localhost:8000/login')

    // Assert that the page contains a specific text
    cy.contains('Talleres Lebron').should('be.visible')

    cy.get('input[name="email"]').type('admin@gmail.com');
    cy.get('input[name="password"]').type('password');

    cy.get('button[id="btn-login"]').click();

    cy.url().should('include', '/admin');

    cy.get('a[href="http://localhost:8000/admin/employees"]').click();
    cy.get('a[href="http://localhost:8000/admin/employees/create"]').click();


    cy.get('input[id="first_name"]').type('Samuel');
  });
})