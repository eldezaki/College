package jobsheet7;

public class Main {
    public static void main(String[] args) {
        Customer customer1 = new Customer("Rian", "0812-0000-0003");
        SavingsAccount savings = new SavingsAccount("A003", customer1, 100000, 0.02);

        Customer customer2 = new Customer("Dewi", "0812-0000-0004");
        CheckingAccount checking = new CheckingAccount("A004", customer2, 100000, 200000);

        Customer customer3 = new Customer("Budi", "0812-0000-0005");
        BusinessAccount business = new BusinessAccount("A005", customer3, 2000000, 25000);

        savings.deposit(50000, "Initial top-up");

        System.out.println("Withdraw 70000 allowed? " + savings.withdraw(70000));
        System.out.println("Withdraw 250000 allowed? " + checking.withdraw(250000));
        System.out.println("Business Withdraw 1500000 allowed? " + business.withdraw(1500000));

        System.out.println("\n=== Output Bank All Accounts ===");
        Bank bank = new Bank(10);
        bank.addAccount(savings);
        bank.addAccount(checking);
        bank.addAccount(business);
        bank.printAllAccounts();
    }
}