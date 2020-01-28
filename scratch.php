--CREATE TABLE tool_category
(
  category_ID INT NOT NULL,
  tool_ID INT NOT NULL,
  FOREIGN KEY (category_ID) REFERENCES category(category_ID),
  FOREIGN KEY (tool_ID) REFERENCES tools(tool_ID),
  PRIMARY KEY (category_ID, tool_ID)
);