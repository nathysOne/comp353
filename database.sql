CREATE TABLE Project (
        ProjectIDpref varchar(3) DEFAULT 'prj',
		ProjectIDsuff int(10) NOT NULL AUTO_INCREMENT,
		
        Status varchar(30) NOT NULL,
        Estimated int(10) NOT NULL,
        Phase varchar(20) NOT NULL,
        Budget int(10),
		PermitCost int(10) NOT NULL,
        PRIMARY KEY (ProjectIDsuff, ProjectIDpref)
);


CREATE TABLE Construction (
		TaskIDpref varchar(3) DEFAULT 'tsk',
		TaskIDsuff int(10) NOT NULL AUTO_INCREMENT,
		
        Task varchar(30) NOT NULL,
        CostPerHrs int(10) NOT NULL,
        TimeInHrs int(10) NOT NULL,
        PRIMARY KEY (TaskIDsuff, TaskIDpref)
);

CREATE TABLE Item (
    	ItemIDpref varchar(3) DEFAULT 'itm',
		ItemIDsuff int(10) NOT NULL AUTO_INCREMENT,
		
        ItemName varchar(30) NOT NULL,
        CostInDollars int(10) NOT NULL,
        DeliveryDays int(10) NOT NULL,
        Supplier varchar(30) NOT NULL,
        PRIMARY KEY (ItemIDsuff, ItemIDpref)
);

CREATE TABLE Users (
    	UsersIDpref varchar(3) DEFAULT 'usr',
		UsersIDsuff int(10) NOT NULL AUTO_INCREMENT,
		
        FirstName varchar(30) NOT NULL,
        LastName varchar(30) NOT NULL,
        Address int(10) NOT NULL,
        PhoneNumb varchar(10) NOT NULL,
        Title varchar(30) NOT NULL,
		LinkingProject varchar(30) NOT NULL,
        PRIMARY KEY (UsersIDsuff, UsersIDpref)
);

CREATE TABLE QtyForItems (
		ProjectIDpref varchar(3) NOT NULL,
		ProjectIDsuff int(10) NOT NULL,
	
		TaskIDpref varchar(3) NOT NULL,
		TaskIDsuff int(10) NOT NULL,
		
    	ItemIDpref varchar(3) NOT NULL,
		ItemIDsuff int(10) NOT NULL,
				
        Quantity int(10) NOT NULL,
       	PRIMARY KEY (ProjectIDpref, ProjectIDsuff, TaskIDpref,
			TaskIDsuff, ItemIDpref, ItemIDsuff)
);

#PROJECT 1

INSERT INTO Project SET
        Status='completed',
        Estimated=888,
        Phase='done',
        Budget=99,
        PermitCost=100;

