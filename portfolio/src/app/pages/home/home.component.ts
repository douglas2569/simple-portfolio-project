import { Component, OnInit } from '@angular/core';
import { dataBase } from '../../database';
import { Database, Project, Skill } from '../../models/database';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  skills!:Array<Skill>
  projects!:Array<Project>

  constructor() { }

  ngOnInit(): void {
    this.mount(dataBase)
  }

  mount(dataBase:Database):void{
    this.skills = dataBase.skills
    this.projects = dataBase.projects
  }

}
