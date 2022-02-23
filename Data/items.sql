CREATE TABLE [dbo].[items]
(
    [itemId] INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    [itemName] NVARCHAR(50) NOT NULL, 
    [itemPrice] FLOAT NULL, 
    [picLoc] NVARCHAR(100) NOT NULL, 
    [availability] INT NOT NULL, 
    [description] NVARCHAR(100) NULL, 
)

INSERT INTO items (itemId, itemName, itemPrice, picLoc, availability, description)
VALUES (0123, 'Painting name here', 4000.00, 'C:/item/location', 5, 'This is the description for the painting');