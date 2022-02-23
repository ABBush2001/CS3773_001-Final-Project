CREATE TABLE [dbo].[Users] (
    [userID]      NCHAR (15)    NOT NULL,
    [FirstName]   NVARCHAR (50) NOT NULL,
    [LastName]    NVARCHAR (50) NOT NULL,
    [Password]    NCHAR (15)    NOT NULL,
    [Email]       NVARCHAR (50) NULL,
    [PhoneNumber] NVARCHAR (10) NULL,
    PRIMARY KEY CLUSTERED ([userID] ASC)
);

