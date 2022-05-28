# DBMS-Lab-Mini-Project
Tables:

1]BLOOD => Name(PK),Quantity

2]ADMIN => Email(PK),FirstName,LastName,Phone,Gender,Password

3]USER => FirstName,LastName,DateOfBirth,Gender,Phone,Address,BloodType(FK: BLOOD(Name),Email(PK),Password

4]CAMP => CampID(PK),CampDate,Location,EmpID(FK: ADMIN(Email)

5}REGISTER => RegistrationID(PK},CampID(PK,FK: CAMP(CampID),UserID(FK: USER(Email)

6]DONATED => DonationID(PK),CampID(PK,FK: CAMP(CampID),UserID(PK,FK: USER(Email),Quantity
