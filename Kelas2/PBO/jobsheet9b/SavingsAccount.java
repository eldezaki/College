package jobsheet9b;

public class SavingsAccount extends Account implements InterestBearing {
    private static final double MINIMUM_BALANCE = 50000;
    private double interestRate;

    @Override
    public void applyInterest() {
        double interest = getBalance() * interestRate;
        deposit(interest);
    }

    public double monthlyFee() {
        return 0;
    }

    public SavingsAccount(String accountNumber, Customer owner, double balance, double interestRate) {
        super(accountNumber, owner, balance);
        this.interestRate = interestRate;
    }

    public double getInterestRate() {
        return interestRate;
    }

    @Override
    protected boolean canWithdraw(double amount) {
        return amount > 0 && (getBalance() - amount) >= MINIMUM_BALANCE;
    }

    @Override
    public void printInfo() {
        super.printInfo();
        System.out.println("Account type: Savings, interest rate: " + interestRate);
    }
}