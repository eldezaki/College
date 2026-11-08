package jobsheet10;

public class Main {
    public static void main(String[] args) {
        Customer customer1 = new Customer("Nadia", "0812-0000-0001");
        SavingsAccount acc1 = new SavingsAccount("A001", customer1, 500000, 0.01);

        Bank bank = new Bank(10);
        bank.addAccount(acc1);

        try {
            Account found = bank.findAccount("A001");
            System.out.println("Rekening ditemukan: " + found.getAccountNumber());
        } catch (AccountNotFoundException e) {
            System.out.println("Error pencarian: " + e.getMessage());
        }

        try {
            Account notFound = bank.findAccount("A999");
            System.out.println("Rekening ditemukan: " + notFound.getAccountNumber());
        } catch (AccountNotFoundException e) {
            System.out.println("Error pencarian: " + e.getMessage());
        }
    }
}