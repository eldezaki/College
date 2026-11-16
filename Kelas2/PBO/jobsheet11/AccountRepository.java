package jobsheet11;

import java.util.Collection;

public interface AccountRepository {
    void save(Account account);

    Account findByNumber(String accountNumber);

    Collection<Account> findAll();
}