package jobsheet4;

public class Main {
    public static void main(String[] args) {
        Customer customer1 = new Customer("Nadia", "0812-0000-0001");
        Customer customer2 = new Customer("Sari", "0812-0000-0002");

        Account acc1 = new Account("A001", customer1, 500000);
        acc1.withdraw(150000);

        Account acc2 = new Account("A002", customer2, 200000);
        Account acc3 = new Account("A003", customer1, 1000000);

        Bank bank = new Bank(10);
        bank.addAccount(acc1);
        bank.addAccount(acc2);
        bank.addAccount(acc3);

        System.out.println("--- Seluruh Rekening ---");
        bank.printAllAccounts();

        System.out.println("\n--- Cari Rekening A002 ---");
        Account found = bank.findAccount("A002");
        if (found != null) {
            found.printInfo();
        }

        System.out.println("\n--- Cari Rekening Atas Nama Nadia ---");
        Account[] nadiaAccounts = bank.findAccountsByOwnerName("Nadia");
        System.out.println("Jumlah rekening Nadia: " + nadiaAccounts.length);
        for (Account acc : nadiaAccounts) {
            acc.printInfo();
        }
    }
}