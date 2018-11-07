# L3. Requirements and Code Quality

demo : [my side](http://ah224cy.000webhostapp.com/)

## what you need to run

* . php 5.6
* . a env.php file, get the code from env.php.default an add information that need to be given there
* . a json file where you can add snipps to with [] in it

##  Features

the extra Feature in the application are code snipp chering where program can shere short bits of code with 
each other, when you are loggin you can add code snipp for others to see. You can also edit and remove code snipps of your own.

User that are loggin or not loggin can see all code snipps the that users have created, you can also list CodeSnipps by the type of
code it is. 

 * LogginSystem
 * View Code Snipps (loggout and loggin)
 * add Code Snipps (loggin)
 * dealte Code Snipps of your (loggin) 
 * edit Code Snipps of your (loggin )

## not implomented

* edit snipp US 4
* list snipps by type US2


# UserCase

## Us 1 ViewSnipps

# main cinario

* 1. start with user whants to view snipps 
* 2. user press the see snipps link
* 3. Users see all the snipps

## US 2 listSnipps by type 

* 1. User Whant to Whants to view snipps
* 2. User press the see snipps link
* 3. User Chose with Code type with a switch type of diffrent code and press find Snipps
* 4. User get all snipps from the switch 
## US 3 AddSnip

* 1. start with user loggin
* 2. user press add snipps link
* 3. fills the input form to add snipps
* 4. snipp save and user get a message that the snipp is created 

# Alternate Scinario

* 3a . user Don't type in all input
        i. system pressent a error message
        ii. step in to cenarion 3
    

## US 4 User what to dealte a snipp of theres

* 1. start with user loggin
* 2. user press removeSnipp
* 3. chose one of the users snipps 
* 4. the side reaload and you see that the snipp is remove

## US 5 User whant to edit one of theres snipp

* 1. start white user loggin
* 2. user press the link edit snipp 
* 3. user chose a snipp to edit
* 4. user change the info they whant to edit
* 5. user press the change button and get message snipp edited

# Alternate Scinario

* 3.a User don't have any input in the form
    i. system present a error message
    ii. step in to cenario 4

## Test cases

# 1.1 view snipp

# input 

* user press view snipp 

# output

* see View all Snips
* see a go back link

# 1.2 add Snipp 

## pre condition 
    
    user is loggin

# 1.2.1 all done correct

# input

* press the link add Snipp
* write in the title input hello world
* write in the title input Console.log('hello world')
* press the submit button

# output

* get a message with the text code snipp create


# 1.2.2 alt no input in title

# input

* press add snipp link
* in the snip textarea write console.log(hello world)
* press to submit button;

# output

* get a message with the text title is missing input


# 1.2.3 alt no input in string

# input 

* press add snipp link
* write in title input hello world
* press to submit button;

# output 

* get a message with snipp is missing input;

# 1.3 RemoveSnipp 

## pre condition 
    
    user is loggin

# input 
* . test case 1.2.1 
* press to go back link 
* click on remove removesnipp link
* remove the snipp you created

# output

* the snipp is removed
