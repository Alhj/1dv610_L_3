# L3 

## what you need to run

* . php 5.6
* . a env.php file get the code from env.php.default an add information that need to be given there
* . a json file where you can add snipps to with [] in it

#UserCase

##Us 1 ViewSnipps

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
* 3. fills the input form with input
* 4. snipp save and user get a message that the snipp is created 

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

## Test cases

# 1.1 view snipp

*    1. press see snipps
*    2. see all the snipps in the json file on the side

# 1.2 add Snipp 

## pre condition 
    
    user is loggin

#1.2.1 all done correct

* 1. press add snipp link
* 2. write in title input hello world
* 3. in the snip textarea write console.log(hello world)
* 4. press to submit button;
* 5. get a message with code snipp create;

#1.2.2 alt no input in title

* 1. press add snipp link
* 2. in the snip textarea write console.log(hello world)
* 3. press to submit button;
* 4. get a message with title is missing input;

#1.2.3 alt no input in string

* 1. press add snipp link
* 2. write in title input hello world
* 3. press to submit button;
* 4. get a message with snipp is missing input;